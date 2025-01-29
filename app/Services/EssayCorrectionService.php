<?php

namespace App\Services;

use App\Models\Essay;
use App\Models\EssayCorrection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EssayCorrectionService
{
    protected $deepseekApiKey;
    protected $deepseekApiUrl = 'https://api.deepseek.com/chat/completions';
    
    public function __construct()
    {
        $this->deepseekApiKey = config('services.deepseek.api_key');
    }

    public function correctEssay(Essay $essay)
    {
        try {
            // 獲取當前語系
            $locale = app()->getLocale();
            Log::info('開始批改作文 - 詳細資訊', [
                'essay_id' => $essay->id, 
                'title' => $essay->title,
                'current_locale' => $locale,
                'app_locale' => app()->getLocale(),
                'session_locale' => session()->get('locale'),
                'available_locales' => config('app.available_locales', [])
            ]);
            
            // 準備 Deepseek 提示詞
            $prompt = $this->preparePrompt($essay);
            $systemPrompt = $this->getSystemPrompt($locale);
            
            Log::info('生成提示詞 - 詳細資訊', [
                'prompt' => $prompt,
                'system_prompt' => $systemPrompt,
                'locale' => $locale,
                'template_locale' => $this->getPromptTemplate($locale)
            ]);
            
            // 檢查 API 金鑰
            if (empty($this->deepseekApiKey)) {
                Log::error('Deepseek API 金鑰未設置');
                throw new \Exception('Deepseek API key is not configured');
            }
            
            Log::info('準備呼叫 Deepseek API', [
                'api_url' => $this->deepseekApiUrl,
                'model' => config('services.deepseek.model')
            ]);
            
            // 呼叫 Deepseek API
            $response = Http::timeout(60)
                ->retry(3, 100)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->deepseekApiKey,
                    'Content-Type' => 'application/json',
                ])->post($this->deepseekApiUrl, [
                    'model' => config('services.deepseek.model', 'deepseek-chat'),
                    'response_format' => ['type' => 'json_object'],
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 2000
                ]);

            if (!$response->successful()) {
                Log::error('API 請求失敗', [
                    'status_code' => $response->status(),
                    'error' => $response->body()
                ]);
                throw new \Exception('API request failed: ' . $response->body());
            }

            Log::info('收到 API 回應', [
                'status_code' => $response->status(),
                'response_body' => $response->body()
            ]);

            // 解析 API 回應
            $result = json_decode($response->body(), true);
            
            if (!isset($result['choices'][0]['message']['content'])) {
                Log::error('API 回應格式無效', ['result' => $result]);
                throw new \Exception('Invalid API response format');
            }

            $feedback = json_decode($result['choices'][0]['message']['content'], true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('JSON 解析失敗', ['error' => json_last_error_msg()]);
                throw new \Exception('Failed to parse JSON response');
            }
            
            Log::info('解析後的回饋', ['feedback' => $feedback]);

            // 在解析回應後，記錄更多資訊
            Log::info('API 回應解析結果', [
                'feedback_raw' => $result['choices'][0]['message']['content'],
                'feedback_parsed' => $feedback,
                'json_error' => json_last_error(),
                'json_error_msg' => json_last_error_msg()
            ]);

            // 獲取語言代碼前記錄
            Log::info('準備獲取語言代碼', [
                'input_locale' => $locale,
                'available_mappings' => $this->getLanguageCode('debug_list')
            ]);

            // 根據當前語系選擇要儲存的語言版本
            $languageCode = $this->getLanguageCode($locale);
            
            Log::info('準備儲存批改結果', [
                'language_code' => $languageCode,
                'feedback_keys' => array_keys($feedback),
                'will_store_fields' => [
                    'grammar_corrections_' . $languageCode,
                    'content_suggestions_' . $languageCode,
                    'vocabulary_suggestions_' . $languageCode,
                    'overall_feedback_' . $languageCode
                ]
            ]);
            
            // 儲存批改結果
            $data = [
                'essay_id' => $essay->id,
                'grammar_score' => $feedback['grammar_score'],
                'content_score' => $feedback['content_score'],
                'structure_score' => $feedback['structure_score'],
                'vocabulary_score' => $feedback['vocabulary_score'],
                'grammar_corrections_' . $languageCode => $feedback['grammar_corrections'],
                'content_suggestions_' . $languageCode => $feedback['content_suggestions'],
                'vocabulary_suggestions_' . $languageCode => $feedback['vocabulary_suggestions'],
                'overall_feedback_' . $languageCode => $feedback['overall_feedback']
            ];

            Log::info('即將創建資料庫記錄', [
                'data' => $data,
                'model_fillable' => (new EssayCorrection())->getFillable()
            ]);

            $correction = EssayCorrection::create($data);

            Log::info('作文批改完成 - 詳細資訊', [
                'essay_id' => $essay->id,
                'correction_id' => $correction->id,
                'language_code' => $languageCode,
                'stored_data' => $correction->toArray()
            ]);

            return $correction;

        } catch (\Exception $e) {
            Log::error('作文批改失敗 - 詳細錯誤', [
                'essay_id' => $essay->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'previous' => $e->getPrevious() ? $e->getPrevious()->getMessage() : null
            ]);
            throw $e;
        }
    }

    protected function preparePrompt(Essay $essay): string
    {
        // 獲取當前語系
        $locale = app()->getLocale();
        Log::info('準備生成提示詞', ['當前語系' => $locale]);

        // 根據語系獲取對應的提示詞模板
        $template = $this->getPromptTemplate($locale);
        
        return sprintf($template,
            $essay->title,
            $essay->topic_type,
            $essay->content
        );
    }

    protected function getPromptTemplate($locale): string
    {
        $templates = [
            'ja' => [
                'template' => "以下の英語エッセイを添削してください：\n\n" .
                             "タイトル：%s\n" .
                             "タイプ：%s\n" .
                             "内容：\n%s\n\n" .
                             "以下の形式で評価を提供してください：\n" .
                             "Grammar Score: (文法スコア)\n" .
                             "Content Score: (内容スコア)\n" .
                             "Structure Score: (構成スコア)\n" .
                             "Vocabulary Score: (語彙スコア)\n" .
                             "Grammar Corrections: (文法の修正点を詳しく説明してください)\n" .
                             "Content Suggestions: (内容の改善点を詳しく説明してください)\n" .
                             "Vocabulary Suggestions: (語彙の改善提案を詳しく説明してください)\n" .
                             "Overall Feedback: (全体的な評価を詳しく説明してください)"
            ],
            'ko' => [
                'template' => "다음 영어 에세이를 첨삭해 주세요：\n\n" .
                             "제목：%s\n" .
                             "유형：%s\n" .
                             "내용：\n%s\n\n" .
                             "다음 형식으로 평가를 제공해 주세요：\n" .
                             "Grammar Score: (문법 점수)\n" .
                             "Content Score: (내용 점수)\n" .
                             "Structure Score: (구조 점수)\n" .
                             "Vocabulary Score: (어휘 점수)\n" .
                             "Grammar Corrections: (문법 수정 사항을 자세히 설명해 주세요)\n" .
                             "Content Suggestions: (내용 개선 사항을 자세히 설명해 주세요)\n" .
                             "Vocabulary Suggestions: (어휘 개선 제안을 자세히 설명해 주세요)\n" .
                             "Overall Feedback: (전체적인 평가를 자세히 설명해 주세요)"
            ],
            'vi' => [
                'template' => "Vui lòng sửa bài luận tiếng Anh sau：\n\n" .
                             "Tiêu đề：%s\n" .
                             "Loại：%s\n" .
                             "Nội dung：\n%s\n\n" .
                             "Vui lòng đánh giá theo định dạng sau：\n" .
                             "Grammar Score: (Điểm ngữ pháp)\n" .
                             "Content Score: (Điểm nội dung)\n" .
                             "Structure Score: (Điểm cấu trúc)\n" .
                             "Vocabulary Score: (Điểm từ vựng)\n" .
                             "Grammar Corrections: (Đề xuất sửa lỗi ngữ pháp)\n" .
                             "Content Suggestions: (Đề xuất cải thiện nội dung)\n" .
                             "Vocabulary Suggestions: (Đề xuất cải thiện từ vựng)\n" .
                             "Overall Feedback: (Đánh giá tổng thể)"
            ],
            'zh_tw' => [
                'template' => "請幫我批改以下英文作文：\n\n" .
                             "標題：%s\n" .
                             "類型：%s\n" .
                             "內容：\n%s\n\n" .
                             "請提供以下格式的回應：\n" .
                             "Grammar Score: (分數)\n" .
                             "Content Score: (分數)\n" .
                             "Structure Score: (分數)\n" .
                             "Vocabulary Score: (分數)\n" .
                             "Grammar Corrections: (文法修正建議，請列出具體錯誤並提供正確用法)\n" .
                             "Content Suggestions: (內容改進建議，包含論點發展、邏輯連貫性等)\n" .
                             "Vocabulary Suggestions: (用詞建議，提供更好的替代詞彙)\n" .
                             "Overall Feedback: (整體評語，總結優點和需要改進的地方)"
            ],
            'zh_cn' => [
                'template' => "请帮我批改以下英文作文：\n\n" .
                             "标题：%s\n" .
                             "类型：%s\n" .
                             "内容：\n%s\n\n" .
                             "请提供以下格式的回应：\n" .
                             "Grammar Score: (分数)\n" .
                             "Content Score: (分数)\n" .
                             "Structure Score: (分数)\n" .
                             "Vocabulary Score: (分数)\n" .
                             "Grammar Corrections: (文法修正建议，请列出具体错误并提供正确用法)\n" .
                             "Content Suggestions: (内容改进建议，包含论点发展、逻辑连贯性等)\n" .
                             "Vocabulary Suggestions: (用词建议，提供更好的替代词汇)\n" .
                             "Overall Feedback: (整体评语，总结优点和需要改进的地方)"
            ],
            'en' => [
                'template' => "Please correct the following English essay:\n\n" .
                             "Title: %s\n" .
                             "Type: %s\n" .
                             "Content:\n%s\n\n" .
                             "Please provide feedback in the following format:\n" .
                             "Grammar Score: (score)\n" .
                             "Content Score: (score)\n" .
                             "Structure Score: (score)\n" .
                             "Vocabulary Score: (score)\n" .
                             "Grammar Corrections: (detailed grammar corrections)\n" .
                             "Content Suggestions: (content improvement suggestions)\n" .
                             "Vocabulary Suggestions: (vocabulary enhancement suggestions)\n" .
                             "Overall Feedback: (comprehensive evaluation)"
            ]
        ];

        // 標準化語言代碼
        $normalizedLocale = str_replace('-', '_', strtolower($locale));
        
        Log::info('選擇提示詞模板 - 詳細資訊', [
            '原始語系' => $locale,
            '標準化語系' => $normalizedLocale,
            '可用模板' => array_keys($templates),
            '選擇模板' => isset($templates[$normalizedLocale]) ? $normalizedLocale : 'en'
        ]);

        return $templates[$normalizedLocale]['template'] ?? $templates['en']['template'];
    }

    protected function getSystemPrompt($locale): string
    {
        // 標準化語言代碼
        $normalizedLocale = str_replace('-', '_', strtolower($locale));
        
        $systemPrompts = [
            'ja' => 'あなたは英語教師として、学生の英語エッセイを添削します。
必ず日本語でフィードバックを提供してください。英語は使用せず、すべての説明を日本語で行ってください。
評価は必ずJSON形式で返してください。評価基準は以下の通りです：

{
    "grammar_score": 数値（0-100）,
    "content_score": 数値（0-100）,
    "structure_score": 数値（0-100）,
    "vocabulary_score": 数値（0-100）,
    "grammar_corrections": "文法の修正点を日本語で詳しく説明してください。例：「この部分は現在完了形を使うべきです」",
    "content_suggestions": "内容の改善点を日本語で詳しく説明してください。例：「この段落ではより具体的な例を挙げると良いでしょう」",
    "vocabulary_suggestions": "語彙の改善提案を日本語で詳しく説明してください。例：「この単語の代わりにより適切な表現として〜があります」",
    "overall_feedback": "全体的な評価を日本語で詳しく説明してください。良い点と改善点を含めて説明してください"
}

重要な注意事項：
1. すべてのフィードバックは必ず日本語で提供してください
2. 英語での説明は避け、すべて日本語で説明してください
3. 具体的で実用的なアドバイスを提供してください
4. 文法の修正は具体的な例を挙げて説明してください
5. JSONフォーマットを厳密に守ってください',

            'ko' => '영어 교사로서 학생의 영어 에세이를 첨삭합니다.
반드시 한국어로 피드백을 제공해 주세요. 영어는 사용하지 말고, 모든 설명을 한국어로 해주세요.
평가는 반드시 JSON 형식으로 반환해 주세요. 평가 기준은 다음과 같습니다：

{
    "grammar_score": 숫자（0-100）,
    "content_score": 숫자（0-100）,
    "structure_score": 숫자（0-100）,
    "vocabulary_score": 숫자（0-100）,
    "grammar_corrections": "문법 수정 사항을 한국어로 자세히 설명해 주세요. 예: 「이 부분은 현재완료형을 사용해야 합니다」",
    "content_suggestions": "내용 개선 사항을 한국어로 자세히 설명해 주세요. 예: 「이 단락에서는 더 구체적인 예시를 들면 좋겠습니다」",
    "vocabulary_suggestions": "어휘 개선 제안을 한국어로 자세히 설명해 주세요. 예: 「이 단어 대신 더 적절한 표현으로 〜를 사용하면 좋겠습니다」",
    "overall_feedback": "전체적인 평가를 한국어로 자세히 설명해 주세요. 장점과 개선점을 포함해서 설명해 주세요"
}

중요 주의사항：
1. 모든 피드백은 반드시 한국어로 제공해 주세요
2. 영어 설명은 피하고, 모든 설명을 한국어로 해주세요
3. 구체적이고 실용적인 조언을 제공해 주세요
4. 문법 수정은 구체적인 예시를 들어 설명해 주세요
5. JSON 형식을 엄격히 지켜주세요',

            'zh_tw' => '您是一位專業的英文教師，將為學生的英文作文提供修改建議。
請務必使用繁體中文提供回饋。請勿使用英文，所有說明都必須使用繁體中文。
評分必須以JSON格式回傳。評分標準如下：

{
    "grammar_score": 數字（0-100）,
    "content_score": 數字（0-100）,
    "structure_score": 數字（0-100）,
    "vocabulary_score": 數字（0-100）,
    "grammar_corrections": "請用繁體中文詳細說明文法修正建議。例如：「這裡應該使用現在完成式，因為...」",
    "content_suggestions": "請用繁體中文詳細說明內容改進建議。例如：「這段落可以加入更具體的例子來支持論點」",
    "vocabulary_suggestions": "請用繁體中文詳細說明用詞改進建議。例如：「『important』可以替換成更正式的『significant』」",
    "overall_feedback": "請用繁體中文詳細說明整體評語，包含優點和需要改進的地方"
}

重要注意事項：
1. 所有回饋必須使用繁體中文提供
2. 避免使用英文解釋，全程使用繁體中文說明
3. 提供具體且實用的建議
4. 文法修正時要舉具體例子說明
5. 嚴格遵守JSON格式',

            'zh_cn' => '您是一位专业的英文教师，将为学生的英文作文提供修改建议。
请务必使用简体中文提供反馈。请勿使用英文，所有说明都必须使用简体中文。
评分必须以JSON格式返回。评分标准如下：

{
    "grammar_score": 数字（0-100）,
    "content_score": 数字（0-100）,
    "structure_score": 数字（0-100）,
    "vocabulary_score": 数字（0-100）,
    "grammar_corrections": "请用简体中文详细说明语法修正建议。例如：「这里应该使用现在完成时，因为...」",
    "content_suggestions": "请用简体中文详细说明内容改进建议。例如：「这段落可以加入更具体的例子来支持论点」",
    "vocabulary_suggestions": "请用简体中文详细说明用词改进建议。例如：「『important』可以替换成更正式的『significant』」",
    "overall_feedback": "请用简体中文详细说明整体评语，包含优点和需要改进的地方"
}

重要注意事项：
1. 所有反馈必须使用简体中文提供
2. 避免使用英文解释，全程使用简体中文说明
3. 提供具体且实用的建议
4. 语法修正时要举具体例子说明
5. 严格遵守JSON格式',

            'vi' => 'Với tư cách là giáo viên tiếng Anh, bạn sẽ chấm và sửa bài luận tiếng Anh của học sinh.
Vui lòng cung cấp phản hồi bằng tiếng Việt. Không sử dụng tiếng Anh, tất cả giải thích phải bằng tiếng Việt.
Đánh giá phải được trả về dưới dạng JSON. Tiêu chí đánh giá như sau:

{
    "grammar_score": số điểm（0-100）,
    "content_score": số điểm（0-100）,
    "structure_score": số điểm（0-100）,
    "vocabulary_score": số điểm（0-100）,
    "grammar_corrections": "Giải thích chi tiết các đề xuất sửa lỗi ngữ pháp bằng tiếng Việt. Ví dụ: 「Phần này nên sử dụng thì hiện tại hoàn thành vì...」",
    "content_suggestions": "Giải thích chi tiết các đề xuất cải thiện nội dung bằng tiếng Việt. Ví dụ: 「Đoạn văn này nên thêm ví dụ cụ thể để hỗ trợ luận điểm」",
    "vocabulary_suggestions": "Giải thích chi tiết các đề xuất cải thiện từ vựng bằng tiếng Việt. Ví dụ: 「Thay vì dùng từ 『important』, có thể dùng từ trang trọng hơn là 『significant』」",
    "overall_feedback": "Giải thích chi tiết đánh giá tổng thể bằng tiếng Việt, bao gồm ưu điểm và những điểm cần cải thiện"
}

Lưu ý quan trọng:
1. Tất cả phản hồi phải được cung cấp bằng tiếng Việt
2. Tránh sử dụng tiếng Anh, giải thích mọi thứ bằng tiếng Việt
3. Đưa ra những đề xuất cụ thể và thiết thực
4. Khi sửa ngữ pháp, phải đưa ra ví dụ cụ thể
5. Tuân thủ nghiêm ngặt định dạng JSON',

            'en' => 'You are an English teacher providing feedback on student essays. Your evaluation must be returned in JSON format. The evaluation criteria are as follows:
                {
                    "grammar_score": number（0-100）,
                    "content_score": number（0-100）,
                    "structure_score": number（0-100）,
                    "vocabulary_score": number（0-100）,
                    "grammar_corrections": "detailed grammar correction suggestions",
                    "content_suggestions": "detailed content improvement suggestions",
                    "vocabulary_suggestions": "detailed vocabulary improvement suggestions",
                    "overall_feedback": "detailed overall evaluation"
                }'
        ];

        Log::info('選擇系統提示詞 - 詳細資訊', [
            '原始語系' => $locale,
            '標準化語系' => $normalizedLocale,
            '可用語系' => array_keys($systemPrompts),
            '選擇語系' => isset($systemPrompts[$normalizedLocale]) ? $normalizedLocale : 'en'
        ]);

        return $systemPrompts[$normalizedLocale] ?? $systemPrompts['en'];
    }

    protected function getLanguageCode($locale): string
    {
        // 標準化語言代碼映射
        $languageMap = [
            'ja' => 'ja',
            'ko' => 'ko',
            'vi' => 'vi',
            'zh_tw' => 'zh_tw',
            'zh-tw' => 'zh_tw',
            'zh_cn' => 'zh_cn',
            'zh-cn' => 'zh_cn',
            'en' => 'en',
            'en_us' => 'en'
        ];

        // 如果是調試模式，返回所有映射
        if ($locale === 'debug_list') {
            return json_encode($languageMap);
        }

        // 標準化輸入的語言代碼
        $normalizedLocale = str_replace(['-', '_'], '_', strtolower($locale));
        
        // 如果是簡短語言代碼（例如 'ja'），直接使用
        if (isset($languageMap[$normalizedLocale])) {
            Log::info('使用完全匹配的語言代碼', [
                '原始語系' => $locale,
                '標準化語系' => $normalizedLocale,
                '使用代碼' => $languageMap[$normalizedLocale]
            ]);
            return $languageMap[$normalizedLocale];
        }
        
        // 如果找不到完全匹配，嘗試使用語言代碼的第一部分
        $shortLocale = explode('_', $normalizedLocale)[0];
        if (isset($languageMap[$shortLocale])) {
            Log::info('使用簡短語言代碼', [
                '原始語系' => $locale,
                '標準化語系' => $normalizedLocale,
                '簡短語系' => $shortLocale,
                '使用代碼' => $languageMap[$shortLocale]
            ]);
            return $languageMap[$shortLocale];
        }

        Log::info('找不到匹配的語言代碼，使用預設值', [
            '原始語系' => $locale,
            '標準化語系' => $normalizedLocale,
            '簡短語系' => $shortLocale,
            '使用代碼' => 'en'
        ]);

        return 'en';
    }
} 
<?php

namespace App\Services;

use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Illuminate\Support\Facades\Storage;

class TextToSpeechService
{
    public function generateAudio($question, $options, $filename)
    {
        // 使用 JSON 憑證來創建 TTS 客戶端
        $client = new TextToSpeechClient([
            'credentials' => storage_path('app/google-cloud/arcane-climber-438608-t5-090156897b35.json'),
        ]);

        // 構建音頻文本，包含問題及其選項，並添加停頓
        $textToSpeak = "
            <speak>
                <s>{$question}</s>
                <break time='4s'/>
                
                <s>A.<break time='1s'/> {$options['option_a']}</s>
                <break time='3s'/>
                <s>B.<break time='1s'/> {$options['option_b']}</s>
                <break time='3s'/>
                <s>C.<break time='1s'/> {$options['option_c']}</s>
                <break time='3s'/>
                <s>D.<break time='1s'/> {$options['option_d']}</s>
                <break time='3s'/>
            </speak>";

        // 設置請求參數
        $input = new SynthesisInput();
        $input->setSsml($textToSpeak); // 使用 SSML

        $voice = new VoiceSelectionParams();
        $voice->setLanguageCode('en-US');
        $voice->setSsmlGender(SsmlVoiceGender::NEUTRAL);

        $audioConfig = new AudioConfig();
        $audioConfig->setAudioEncoding(AudioEncoding::MP3);

        // 執行 TTS 請求
        $response = $client->synthesizeSpeech($input, $voice, $audioConfig);

        // 獲取音頻資料
        $audioContent = $response->getAudioContent();

        // 儲存音頻檔案
        $audioPath = "audio/{$filename}.mp3";  // 儲存到 storage/app/public/audio
        Storage::put($audioPath, $audioContent);

        // 返回音頻檔案URL
        return Storage::url($audioPath);  // 生成可供網頁使用的URL
    }
}


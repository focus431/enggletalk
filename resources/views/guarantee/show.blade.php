<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PECA 擔保證明書</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 18px; /* 縮小整體字體大小 */
        }

        .container {
            background: #ffffff;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 15px;
            width: 100%;
            max-width: 210mm;
            min-height: 297mm;
            box-sizing: border-box;
            margin: 0 auto;
        }

        .border-gradient {
            border-image: linear-gradient(to right, #4a5568, #2d3748);
            border-image-slice: 1;
        }

        .title {
            font-size: 2rem;
            color: #2d3748;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #cbd5e0;
        }

        .section-title {
            color: #2d3748;
            font-size: 1rem;
            font-weight: 600;
            padding-bottom: 5px;
            border-bottom: 1px solid #e2e8f0;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            align-items: center;
        }

        .grid-item {
            padding: 6px;
            border: 1px solid #cbd5e0;
            background-color: #f9fafb;
        }

        .label {
            font-weight: 600;
            color: #2d3748;
        }

        /* 浮水印樣式 */
        .watermark {
            position: absolute;
            top: 57%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.4;
            z-index: 0;
            width: 220px;
            height: auto;
        }

        .content {
            position: relative;
            z-index: 1;
        }

        @media print {
            .container {
                box-shadow: none;
                border-radius: 0;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-50">

    <div class="container mx-auto border border-gradient">
        
        <!-- 浮水印圖片 -->
        <img src="/assets/img/299733.png" alt="浮水印" class="watermark">
        
        <div class="content">
            <img src="{{ asset('assets/img/PECA logo.png') }}" alt="PECA Logo" class="w-20 mx-auto mb-4">
            
            <h1 class="text-center title mb-4">PECA 擔保證明書</h1>

            <form action="{{ route('guarantee.store') }}" method="POST">
                @csrf <!-- Laravel 的 CSRF 安全令牌 -->

                <!-- 學生與就讀資訊 -->
                <section class="mb-6">
                    <h2 class="section-title">證書編號：</span> {{ $certificate->certificate_number }}</h2>
                    <div class="grid-container">
                       
                        <div class="grid-item">
                            <span class="label">學生姓名：</span> {{ $certificate->student_name }}
                        </div>
                        <div class="grid-item">
                            <span class="label">護照號碼：</span> {{ $certificate->id_number }}
                        </div>
                        <div class="grid-item">
                            <span class="label">擔保金額：</span> {{ number_format($certificate->tuition_fee, 0) }} 台幣
                        </div>
                        <div class="grid-item">
                            <span class="label">就讀學校：</span> {{ $certificate->school_name }}
                        </div>
                    </div>
                </section>

                <!-- 代辦資訊 -->
                <section class="mb-6">
                    <h2 class="section-title">代辦資訊</h2>
                    <div class="grid-container">
                        <div class="grid-item">
                            <span class="label">代辦公司名稱：</span> {{ $certificate->agency_name }}
                        </div>
                        <div class="grid-item">
                            <span class="label">負責人姓名：</span> {{ $certificate->agency_responsible_person }}
                        </div>
                        <div class="grid-item">
                            <span class="label">聯絡電話：</span> {{ $certificate->agency_contact }}
                        </div>
                        <div class="grid-item">
                            <span class="label">擔保有效日期：</span> {{ \Carbon\Carbon::parse($certificate->valid_until)->format('Y-m-d') }}
                        </div>
                    </div>
                </section>

                <!-- 擔保條款 -->
                <section class="mb-6">
                    <h2 class="section-title">擔保條款</h2>

                    <div class="text-gray-700 text-sm space-y-3 mt-3">
                        <div>
                            <span class="font-semibold text-gray-800">擔保內容：</span>
                            <p class="ml-5">此擔保證明書僅適用於代辦公司未能將學費以及住宿費按時匯至學校，且因此導致學生無法上課的情況。若發生此情況，PECA將返還學費和住宿費全額。此擔保範圍外的其他問題均不在本擔保涵蓋範圍內。</p>
                        </div>

                        <div>
                            <span class="font-semibold text-gray-800">擔保期限：</span>
                            <p class="ml-5">本擔保自簽發日起生效，有效期限為 學生到校後七天內。在此期限後，無論是否符合退款條件，本擔保將自動失效。</p>
                        </div>

                        <div>
                            <span class="font-semibold text-gray-800">退款條件與程序：</span>
                            <p class="ml-5">如果代辦公司未按時將學費和住宿費匯至學校，導致學生無法上課，學生需在 7 日內 向 PECA 提出退款申請，並提供支付憑證及本擔保證明書。PECA 將依據學生實際未接受教學的時段按比例計算退費，並在核實後的 30 個工作日內 完成退款。退款金額最高不超過學生已支付的學費與住宿費總額。</p>
                        </div>

                        <div>
                            <span class="font-semibold text-gray-800">例外條款：</span>
                            <p class="ml-5">若發現學生或代辦公司提供虛假資訊或涉及欺詐行為，本擔保立即失效，PECA有權不予退款並取消相關資格。</p>
                            <p class="ml-5">本擔保僅適用於學生學費以及住宿費，不包括交通、水電費、學雜費等額外費用。</p>
                            <p class="ml-5">若因不可抗力事件（如天災、戰爭等）導致學校的服務無法正常提供，本擔保也將自動失效。</p>
                        </div>

                        <!-- 補回缺失的條款文字 -->
                        <div>
                            <span class="font-semibold text-gray-800">責任聲明：</span>
                            <p class="ml-5">本擔保書僅為學生權益保障之用，PECA 將依據擔保範圍履行相關責任。如有爭議，PECA 保留最終解釋權。</p>
                        </div>
                    </div>
                </section>

                <!-- 簽章區域 -->
                <section class="flex justify-around items-center mt-8 pt-4 border-t border-gray-300">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/peca_signature.png') }}" alt="PECA 簽章" class="w-16 mx-auto mb-2">
                        <div class="signature-line mx-auto"></div>
                        <p class="mt-2 text-xs text-gray-600">PECA 簽章</p>
                    </div>
                    <div class="text-center">
                        <img src="{{ asset('assets/img/peca_signature_1.png') }}" alt="PECA協會簽章" class="w-12 mx-auto mb-2">
                        <div class="signature-line mx-auto"></div>
                        <p class="mt-2 text-xs text-gray-600">理事長簽章</p>
                    </div>
                </section>
            </form>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PECA 擔保證明書</title>
    <style>
        body {
            font-family: Arial, 'Microsoft JhengHei', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fefefe;
            text-align: center;
        }
        .logo {
            width: 150px;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 24px;
            margin-top: 0;
        }
        .info, .terms {
            margin-bottom: 20px;
            text-align: left;
        }
        .info-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        .info-table, .signatures-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table th, .info-table td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .info-table th {
            background-color: #f2f2f2;
            width: 35%;
        }
        .info-table input, .info-table select {
            width: 100%;
            box-sizing: border-box;
            font-size: 14px;
            border: 1px solid #ccc;
            padding: 5px;
            background-color: #f9f9f9;
        }
        .inline-fields {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .inline-fields p {
            display: flex;
            align-items: center;
            margin: 0;
            font-weight: bold;
            color: #555;
        }
        .terms-title {
            font-weight: bold;
            font-size: 18px;
            color: #555;
            margin-bottom: 5px;
        }
        .terms-section {
            margin-bottom: 10px;
        }
        .terms-section-title {
            font-weight: bold;
            display: inline;
        }
        .terms-section p {
            margin: 5px 0;
            text-indent: 2em;
        }
        .signatures-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding-top: 40px;
        }
        .signature-line {
            width: 60%;
            margin: 0 auto;
            padding-top: 5px;
            border-top: 1px solid #333;
            margin-top: 10px;
        }
        .footer-note {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
            text-align: center;
        }
        /* 在列印時隱藏 LOGO 和頁尾 */
        @media print {
            .footer-note {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('assets/img/PECA logo.png') }}" alt="PECA Logo" class="logo">
        
        <h1>PECA擔保證明書</h1>

        <form action="{{ route('guarantee.store') }}" method="POST">
            @csrf <!-- Laravel 的 CSRF 安全令牌 -->
            <div class="inline-fields">
                <p><strong>證書編號：</strong><input type="text" name="certificate_number" id="certificate-number" readonly></p>
                <p><strong>簽發日期：</strong><input type="date" name="issue_date" id="issue-date"></p>
                <p><strong>有效期限：</strong>至 <input type="date" name="valid_until" placeholder="例如：學生出發前一週" required></p>
            </div>

            <div class="info">
                <div class="info-title">學生與就讀資訊</div>
                <table class="info-table">
                    <tr><th>學生護照拚音</th><td><input type="text" name="student_name" placeholder="請輸入護照拚音"></td></tr>
                    <tr><th>護照號碼</th><td><input type="text" name="id_number" placeholder="請輸入護照號碼"></td></tr>
                    <tr><th>擔保金額</th><td><input type="text" name="tuition_fee" placeholder="台幣"></td></tr>
                    <tr><th>就讀學校</th><td><input type="text" name="school_name" placeholder="請輸入學校名稱"></td></tr>
                </table>
            </div>

            <div class="info">
                <div class="info-title">代辦資訊</div>
                <table class="info-table">
                    <tr>
                        <th>代辦公司名稱</th>
                        <td>
                            <select name="agency_name" id="agency_name">
                                <option value="">請選擇公司名稱</option>
                                <option value="格仲國際有限公司">格仲國際有限公司</option>
                                <option value="仁育國際教育股份有限公司">仁育國際教育股份有限公司</option>
                                <option value="易格國際顧問有限公司">易格國際顧問有限公司</option>
                                <option value="締佳國際教育有限公司">締佳國際教育有限公司</option>
                                <option value="飛鷹生活顧問有限公司">飛鷹生活顧問有限公司</option>
                                <option value="葛瑞特留遊學顧問有限公司">葛瑞特留遊學顧問有限公司</option>
                                <option value="背包客遊學國際有限公司">背包客遊學國際有限公司</option>
                                <option value="歐帕思遊學有限公司">歐帕思遊學有限公司</option>
                                <option value="台灣透客文教有限公司">台灣透客文教有限公司</option>
                                <option value="忠欣海外生活顧問工作室">忠欣海外生活顧問工作室</option>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>負責人姓名</th>
                        <td><input type="text" name="agency_responsible_person" id="agency_responsible_person" placeholder="請輸入負責人姓名" readonly></td>
                    </tr>
                    <tr>
                        <th>聯絡電話</th>
                        <td><input type="text" name="agency_contact" id="agency_contact" placeholder="請輸入電話號碼" readonly></td>
                    </tr>
                    <tr><th>擔保金支付日期</th><td><input type="date" name="payment_date"></td></tr>
                </table>
            </div>

            <div class="terms">               

                <div class="terms-section">
                    <span class="terms-section-title">擔保內容：</span>
                    <p>此擔保證明書僅適用於代辦公司未能將學費以及住宿費按時匯至學校，且因此導致學生無法上課的情況。若發生此情況，PECA將返還學費和住宿費全額。此擔保範圍外的其他問題均不在本擔保涵蓋範圍內。</p>
                    </div>

                <div class="terms-section">
                    <span class="terms-section-title">擔保期限：</span>
                    <p>本擔保自簽發日起生效，至學生出發或符合退款條件為止。擔保期限最晚至學生到校後一週。</p>
                </div>

            

                <div class="terms-section">
                    <span class="terms-section-title">退款程序：</span>
                    <p>若代辦公司未按時將學費和住宿費匯至學校，且因此導致學生無法上課，學生需在得知該情況後30天內向PECA提出退款申請，並附上支付憑證及本擔保證明書。PECA將根據學生實際未受教時段按比例核算退費，並在核實後的30個工作日內完成退款，最高退費金額為學費和住宿費全額。</p>
                </div>

                <div class="terms-section">
                    <span class="terms-section-title">例外條款：</span>
                    <p>若學生或代辦公司提供虛假資訊或涉及欺詐行為，PECA有權取消擔保並拒絕退款。本擔保僅適用於學費和住宿費，不涵蓋其他費用如交通費、雜費等。</p>
                    <p>若因不可抗力事件（如天災、戰爭等）導致學校的服務無法正常提供，本擔保也將自動失效。</p>
                </div>
            </div>

            <div class="signatures">
                <table class="signatures-table">
                    <tr>
                        <td>
                            <div class="signature-line">PECA 簽章</div>
                        </td>
                        <td>
                            <div class="signature-line">理事長簽章</div>
                        </td>
                    </tr>
                </table>
            </div>

            <button type="submit" style="margin-top: 20px;">提交擔保書</button>
        </form>
    </div>

    <script>
        // 設定代辦公司與聯絡資訊
        const agencyData = {
            "格仲國際有限公司": { responsible_person: "謝仲城", contact: "02-7742-3836" },
            "仁育國際教育股份有限公司": { responsible_person: " 陳振豪", contact: "02-2741-6196" },
            "易格國際顧問有限公司": { responsible_person: "謝妤涵", contact: "04-2314-2898" },
            "締佳國際教育有限公司": { responsible_person: "陳旻宣", contact: "04-2314-2898" },
            "飛鷹生活顧問有限公司": { responsible_person: "劉齡憶", contact: "02-2363-9388" },
            "葛瑞特留遊學顧問有限公司": { responsible_person: "陳淑閨", contact: "03-316-6494" },
            "背包客遊學國際有限公司": { responsible_person: "呂學儀", contact: "02-2361-1152" },
            "歐帕思遊學有限公司": { responsible_person: "石宜明", contact: "03-535-1767" },
            "台灣透客文教有限公司": { responsible_person: "黃秝榛", contact: "04-2326-0342" },
            "忠欣海外生活顧問工作室": { responsible_person: "游至絜", contact: "02-2100-2001" },

        };
        
        // 監聽代辦公司選擇改變
        document.getElementById('agency_name').addEventListener('change', function () {
            const selectedAgency = this.value;
            const responsiblePersonInput = document.getElementById('agency_responsible_person');
            const contactInput = document.getElementById('agency_contact');

            if (agencyData[selectedAgency]) {
                // 填充負責人和聯絡電話
                responsiblePersonInput.value = agencyData[selectedAgency].responsible_person;
                contactInput.value = agencyData[selectedAgency].contact;
            } else {
                // 清空輸入框
                responsiblePersonInput.value = '';
                contactInput.value = '';
            }
        });

        // 預設證書編號
        const certificateInput = document.getElementById('certificate-number');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        certificateInput.value = `PECA-${year}${month}${day}-XXXX`;

        // 預設簽發日期為今天
        const issueDateInput = document.getElementById('issue-date');
        issueDateInput.value = today.toISOString().split('T')[0];
    </script>
</body>
</html>

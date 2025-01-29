// 其他导入和代码
import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import Chat from './components/Chat.vue';

// 定义 updateUserTimezone 函数
function updateUserTimezone() {
    const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    fetch('/update-timezone', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ timezone: userTimeZone })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Timezone updated:', data);
    })
    .catch(error => {
        console.error('Error updating timezone:', error);
    });
}

// 获取用户的浏览器语言
function updateUserLanguage() {
    const userLanguage = navigator.language || navigator.userLanguage;
    
    // 語言代碼映射
    const languageMap = {
        'zh-TW': 'zh_TW',
        'zh': 'zh_TW',
        'zh-CN': 'zh_CN',
        'en': 'en',
        'en-US': 'en',
        'ja': 'ja',
        'ko': 'ko',
        'vi': 'vi'
    };

    // 轉換語言代碼
    const mappedLanguage = languageMap[userLanguage] || 'zh_TW';

    fetch('/update-language', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ language: mappedLanguage })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        // 檢查 Content-Type
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new TypeError("返回的不是 JSON 格式!");
        }
        return response.json();
    })
    .then(data => {
        console.log('語言更新成功:', data);
        if (data.success) {
            // 可選：重新載入頁面以套用新的語言設定
            // window.location.reload();
        }
    })
    .catch(error => {
        console.error('語言更新失敗:', error);
    });
}

// 页面加载时调用函数
document.addEventListener('DOMContentLoaded', function() {
    updateUserLanguage();
    updateUserTimezone();
});

// Vue 应用初始化
// const app = createApp(Chat);

// app.use(PrimeVue);

// app.mount('#app');

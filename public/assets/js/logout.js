// 定義時間常量，單位是毫秒
const IDLE_TIME_TO_CHECK = 5 * 60 * 1000; // 2分鐘

// 狀態變量
let lastActivityTime = Date.now();
let isLoggedIn = true;
let isMediaStreamActive = false;
let checkTimer;
let peer;

// 頁面加載完成後初始化
window.addEventListener('load', initialize);

function initialize() {
  console.log("頁面加載完成，開始監測用戶活動和媒體流");
  startActivityMonitoring();
  startCheckTimer();
  document.addEventListener('visibilitychange', handleVisibilityChange);
}

// 監聽用戶活動，並使用節流函數減少事件觸發頻率
function startActivityMonitoring() {
  console.log("開始監測用戶活動...");
  const throttledReset = throttle(resetCheckTimer, 200); // 每200毫秒最多執行一次
  ['mousemove', 'keydown', 'touchstart', 'touchmove'].forEach(eventType => {
    document.addEventListener(eventType, throttledReset, { passive: true });
  });
}

// 節流函數，用於限制函數的執行頻率
function throttle(func, limit) {
  let inThrottle;
  return function () {
    const args = arguments;
    const context = this;
    if (!inThrottle) {
      func.apply(context, args);
      inThrottle = true;
      setTimeout(() => inThrottle = false, limit);
    }
  }
}

// 重置檢查計時器
function resetCheckTimer() {
  const currentTime = Date.now();
  lastActivityTime = currentTime;

  // 只有在媒體流不活躍時才重啟計時器
  if (!isMediaStreamActive) {
    clearTimeout(checkTimer);
    startCheckTimer();
  }
}

// 啟動檢查計時器
function startCheckTimer() {
  clearTimeout(checkTimer);
  checkTimer = setTimeout(() => {
    const currentTime = Date.now();
    if (isLoggedIn && !isMediaStreamActive && (currentTime - lastActivityTime > IDLE_TIME_TO_CHECK)) {
      console.log("用戶無活動且媒體流不活躍，執行登出");
      logout();
    } else {
      console.log("用戶活躍或媒體流正在使用，不登出");
    }
  }, IDLE_TIME_TO_CHECK);
}

// 頁面可見性檢測
function handleVisibilityChange() {
  if (document.hidden) {
    clearTimeout(checkTimer);
  } else {
    const currentTime = Date.now();
    if (currentTime - lastActivityTime > IDLE_TIME_TO_CHECK) {
      logout();
    } else {
      startCheckTimer();
    }
  }
}

// 包含超時處理的登出函數
async function logout() {
  if (!isLoggedIn) return;

  try {
    console.log("執行登出...");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // 包含超時處理的 fetch 請求
    const response = await fetchWithTimeout('/logout', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams({ logout: true })
    });

    if (!response.ok) {
      throw new Error(`HTTP error: ${response.status}`);
    }

    console.log("登出成功");
  } catch (error) {
    console.error('登出失敗:', error);
  } finally {
    isLoggedIn = false;
    window.location.href = '/';
  }
}

// 帶有超時機制的 fetch 函數
function fetchWithTimeout(url, options, timeout = 5000) {
  return Promise.race([
    fetch(url, options),
    new Promise((_, reject) => setTimeout(() => reject(new Error('Request timed out')), timeout))
  ]);
}

// 初始化並監控 Simple Peer 實例
function initializePeer(localStream) {
  peer = new SimplePeer({
    initiator: true,
    trickle: false,
    stream: localStream,
  });

  monitorSimplePeer();
}

// 監控 Simple Peer 的媒體流活動
function monitorSimplePeer() {
  if (!peer) {
    console.error('Peer is not initialized.');
    return;
  }

  console.log("監控 Simple Peer 的媒體流...");

  const peerEvents = {
    'stream': (stream) => {
      console.log('Peer stream started:', stream);
      updateMediaStreamStatus(true);
    },
    'close': () => {
      console.log('Peer connection closed.');
      updateMediaStreamStatus(false);
    },
    'error': (err) => {
      console.error('Peer error:', err);
      updateMediaStreamStatus(false);
    },
    'connect': () => {
      console.log('Peer connected.');
      updateMediaStreamStatus(true);
    },
    'disconnect': () => {
      console.log('Peer disconnected.');
      updateMediaStreamStatus(false);
    }
  };

  Object.entries(peerEvents).forEach(([event, handler]) => {
    peer.on(event, handler);
  });
}

// 更新媒體流狀態
function updateMediaStreamStatus(active) {
  isMediaStreamActive = active;
  if (active) {
    clearTimeout(checkTimer);
  } else {
    startCheckTimer();
  }
}

// 定期檢查媒體流是否仍在活動
function checkMediaStreamActivity() {
  console.log("定期檢查媒體流狀態...");
  updateMediaStreamStatus(peer && peer.connected);
}

// 登錄成功後停止檢查計時器
function stopTimersOnLogin() {
  console.log("用戶已登錄，停止檢查計時器");
  isLoggedIn = true;
  clearTimeout(checkTimer);
}

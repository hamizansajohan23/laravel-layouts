<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sesi Tamat Tempoh</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .error-container {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      padding: 48px;
      text-align: center;
      max-width: 420px;
      width: 100%;
    }

    .error-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #fbbf24, #f59e0b);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
      font-size: 36px;
      color: #fff;
    }

    .error-code {
      font-size: 48px;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 8px;
    }

    .error-title {
      font-size: 20px;
      font-weight: 600;
      color: #334155;
      margin-bottom: 12px;
    }

    .error-message {
      font-size: 14px;
      color: #64748b;
      line-height: 1.6;
      margin-bottom: 28px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 28px;
      font-size: 14px;
      font-weight: 600;
      font-family: inherit;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      border: none;
    }

    .btn-primary {
      background: linear-gradient(135deg, #3b57f4, #27c2a4);
      color: #fff;
      box-shadow: 0 4px 15px rgba(59, 87, 244, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(59, 87, 244, 0.4);
    }

    .countdown {
      font-size: 13px;
      color: #94a3b8;
      margin-top: 16px;
    }
  </style>
</head>
<body>
  <div class="error-container">
    <div class="error-icon">⏱️</div>
    <div class="error-code">419</div>
    <h1 class="error-title">Sesi Tamat Tempoh</h1>
    <p class="error-message">
      Sesi anda telah tamat tempoh kerana tidak aktif terlalu lama. 
      Sila muat semula halaman dan cuba lagi.
    </p>
    <a href="{{ url()->previous() }}" class="btn btn-primary" onclick="event.preventDefault(); window.location.reload();">
      🔄 Muat Semula Halaman
    </a>
    <p class="countdown">Muat semula automatik dalam <span id="timer">5</span> saat...</p>
  </div>

  <script>
    let seconds = 5;
    const timerEl = document.getElementById('timer');
    
    const countdown = setInterval(() => {
      seconds--;
      timerEl.textContent = seconds;
      
      if (seconds <= 0) {
        clearInterval(countdown);
        window.location.reload();
      }
    }, 1000);
  </script>
</body>
</html>

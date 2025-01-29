<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# 格中線上教學平台

## 專案簡介
格中線上教學平台是一個專業的線上教育配對平台，連接專業導師與學習者，提供便捷的線上學習體驗。

## 主要功能

### 用戶系統
- 導師和學生註冊系統
- 社交媒體登入整合（Microsoft等）
- 用戶驗證和啟動功能

### 課程管理
- 導師搜尋功能
- 課程預約系統
- 行事曆整合
- 即時視訊通話功能

### 支付系統
- 整合ECPay金流服務
- 課程方案管理
- 發票系統
- 匯款記錄管理

### 學習功能
- TOEIC測驗系統
- 即時聊天功能
- 學習進度追蹤
- 收藏喜愛的導師

### 社群功能
- 部落格系統
- 評價和評論功能
- 導師評分系統

### 後台管理
- 完整的後台管理介面
- 用戶管理
- 課程預約管理
- 系統日誌查看

## 技術規格

### 系統需求
- PHP 8.2或8.3
- Laravel 9.x
- MySQL/MariaDB
- Node.js和NPM（前端資源編譯）

### 主要依賴
- Laravel Framework
- Laravel Passport（API認證）
- Laravel Socialite（社交登入）
- Pusher（即時通訊）
- Stripe（支付處理）
- Google Cloud Services
- ECPay SDK

## 安裝說明

1. 克隆專案
```bash
git clone [專案repository URL]
```

2. 安裝PHP依賴
```bash
composer install
```

3. 安裝前端依賴
```bash
npm install
```

4. 環境設定
```bash
cp .env.example .env
php artisan key:generate
```

5. 設定資料庫
```bash
php artisan migrate
php artisan db:seed
```

6. 啟動服務
```bash
php artisan serve
npm run dev
```

## 授權
本專案為私有軟體，版權所有。

## 聯絡資訊
如有任何問題或建議，請聯繫系統管理員。

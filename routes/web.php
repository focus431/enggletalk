<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Mail\ActivationEmail;
use App\Http\Controllers\Auth\ActivationController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SearchMentorController;  // 確保你引入了MentorController
use App\Http\Controllers\ScheduleController;  // 用您實際的控制器名稱替換 "YourController"
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MenteebookingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\PaymentPlanController;
use App\Http\Controllers\FrontBlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderPlanController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\RemittanceController;
use App\Http\Controllers\LogViewerController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\SendEmailController;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\VideoCallController;
use App\Http\Controllers\EcpayController;
use App\Http\Controllers\ToeicTestController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\GuaranteeCertificateController;
use App\Mail\TestMail;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\EssayController;

Route::get('/test-mail', function () {
    Mail::to('leicesl1@gmail.com')->send(new TestMail());
    return '郵件已發送';
});




// 顯示擔保書創建表單
Route::get('/guarantee/create', [GuaranteeCertificateController::class, 'create'])->name('guarantee.create');

// 提交擔保書並儲存資料
Route::post('/guarantee/store', [GuaranteeCertificateController::class, 'store'])->name('guarantee.store');

// 顯示擔保書詳情
Route::get('/guarantee/{certificateNumber}', [GuaranteeCertificateController::class, 'verify'])->name('guarantee.show');









// 解析PDF
Route::get('/parse-pdf', [QuestionController::class, 'parseWord']);
// 隨機題目
Route::get('/random-questions', [QuestionController::class, 'getRandomQuestions']);
Route::post('/submit-answers', [QuestionController::class, 'submitAnswers']);
Route::get('/result', [QuestionController::class, 'showResult'])->name('result');





Route::get('/sitemap', function () {
    Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/about'))
        ->add(Url::create('/contact'))
        ->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap generated!';
});



// 顯示 TOEIC 測驗頁面
Route::get('/toeic-test/{type}', [ToeicTestController::class, 'showTestPage'])->name('toeic.test');

// 提交測驗答案
Route::post('/toeic-test/{type}/submit', [ToeicTestController::class, 'submitTestAnswers'])->name('toeic.test.submit');

// 顯示總成績
Route::get('/toeic-results', [ToeicTestController::class, 'showResults'])->name('toeic.results');









//綠界的設定
Route::post('/ecpay-checkout', [EcpayController::class, 'checkout'])->name('ecpay.checkout');
Route::post('/ecpay-notify', [EcpayController::class, 'notify'])->name('ecpay.notify');
Route::get('/ecpay-return', [EcpayController::class, 'return'])->name('ecpay.return');




Route::get('/paymentplan', [PaymentPlanController::class, 'index'])->name('plans');

// routes/web.php
Route::get('/awaiting-activation', function () {
    return view('awaiting-activation');
})->name('awaiting.activation');

Route::get('/video-call', [VideoCallController::class, 'index'])->name('video.call')->middleware('auth');



Route::get('/favourites', [FavoriteController::class, 'showFavourites'])->name('favourites.show');

Route::post('/toggle-favorite', [FavoriteController::class, 'toggleFavorite'])->name('toggle.favorite');







Route::get('lang/{lang}', function ($lang) {
    $languages = config('app.languages');

    if (array_key_exists($lang, $languages)) {
        Session::put('applocale', $lang);
    } else {
        logger()->info('Attempted to switch to invalid language: ' . $lang);
    }

    return Redirect::back();
})->name('lang.switch');






Route::post('/update-timezone', [BookingController::class, 'updateTimezone'])->middleware('auth');
Route::get('/send-test-email', [SendEmailController::class, 'sendTestEmail']);
Route::post('/update-language', [BookingController::class, 'updateLanguage'])->middleware('auth');

Route::post('/check-remaining-classes', [BookingController::class, 'checkRemainingClasses']);



//社群平台的登錄
Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('auth/microsoft', [SocialAuthController::class, 'redirectToMicrosoft'])->name('microsoft.login');
Route::get('auth/microsoft/callback', [SocialAuthController::class, 'handleMicrosoftCallback']);









Route::get('logs', [LogViewerController::class, 'index'])->name('log-viewer.index');
Route::get('logs/{filename}', [LogViewerController::class, 'show'])->name('log-viewer.show');

// Route::group(['prefix' => 'log-viewer', 'middleware' => 'web'], function () {
//     Route::get('/', [LogViewerController::class, 'index'])->name('log-viewer::dashboard');
//     Route::get('logs', [LogViewerController::class, 'listLogs'])->name('log-viewer::logs.list');
//     Route::get('logs/{date}', [LogViewerController::class, 'show'])->name('log-viewer::logs.show');
//     Route::get('logs/{date}/download', [LogViewerController::class, 'download'])->name('log-viewer::logs.download');
//     Route::delete('logs/{date}', [LogViewerController::class, 'delete'])->name('log-viewer::logs.delete');
// });



Route::middleware(['auth', 'check.session'])->group(function () {
    // 您受保護的路由
});


Route::get('remittances', [RemittanceController::class, 'index'])->name('remittances.index');
// Route::get('remittances/{month}/{year}', [RemittanceController::class, 'show'])->name('remittances.show');
Route::get('/remittances/{year}/{userId}', [RemittanceController::class, 'show'])->name('remittances.show');


Route::get('/getCurrentMentor', [MentorController::class, 'getCurrentMentor']);




Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices')->middleware('auth');
Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.view')->middleware('auth');
Route::get('/invoice/{id}/print', [InvoiceController::class, 'print'])->name('invoice.print')->middleware('auth');



// 提交预订表单并处理数据
Route::post('submit-purchasing', [OrderPlanController::class, 'store'])->name('submit-purchasing');

// 显示预订成功页面
Route::get('booking-success', [OrderPlanController::class, 'bookingSuccess'])->name('booking-success');






Route::get('/get-user-remaining-classes/{id}', [BookingController::class, 'getRemainingClasses']);







Route::get('/dashboard_mentee', [DashboardController::class, 'mentee_index'])
    ->middleware('role:mentee')
    ->name('dashboard_mentee');

Route::get('/dashboard_mentor', [DashboardController::class, 'mentor_index'])
    ->middleware('role:mentor')
    ->name('dashboard_mentor');




// 添加一條用於提交評論的路由
Route::post('/submit-review', [ReviewController::class, 'store']);
// 添加一條用於取得某個Mentor的評論的路由
Route::get('/mentor/reviews/{mentorId}', [ReviewController::class, 'getMentorReviews']);
// 用Fetch取得評論
Route::get('/bookings_mentee/reviews/{id}', [ReviewController::class, 'getReviewsByClassScheduleId']);



// 當用戶訪問 '/home' 或 '/index' 時，自動重定向到根路徑 '/'
Route::redirect('/home', '/');
Route::redirect('/index', '/');

// 定義根路徑 '/' 的 GET 請求
// 當訪問此路徑時，將調用 HomeController 的 index 方法
Route::get('/', [HomeController::class, 'index'])->name('homepage'); // 使用 'page' 作為路由名稱







//FQA
Route::get('/fqa', function () {
    return view('fqa');
});

//課程介紹
Route::get('/course_info', function () {
    return view('course_info');
});
Route::get('/latest_news', function () {
    return view('latest_news');
});


//Comment
Route::post('/comments', [CommentController::class, 'store']);
Route::get('/comments/{blogId}', [CommentController::class, 'getCommentsByBlog']);


//顯示Mentor的自我介紹
Route::get('/profile/{userId?}', [AuthController::class, 'index'])->name('profile');


Route::get('/mentor_bookings', [MenteebookingController::class, 'showMentorBookings'])->name('mentor.bookings');

//Mentor行事曆
Route::get('/schedule-timings', [ScheduleController::class, 'showSchedule'])->name('schedule-timings');
Route::post('/schedule-timings', [ScheduleController::class, 'saveSchedule'])->name('save-schedule');
Route::middleware(['auth'])->group(function () {
    Route::get('/getschedule', [ScheduleController::class, 'getScheduleJson']);
    //購買方案
    Route::post('/checkout', [EcpayController::class, 'checkout']);

});

//更新行事曆的狀態
Route::post('/handle-schedule', [ScheduleController::class, 'handleSchedule']);



//學生預約表
Route::get('/booking/{encryptedUserId}', [BookingController::class, 'show'])->name('booking')->middleware('auth');
Route::get('/get-class-schedule/{mentorId}', [BookingController::class, 'getClassSchedule'])->middleware('auth');
Route::post('/update-booking-status', [BookingController::class, 'updateBookingStatus'])->middleware('auth');
// 使用 Laravel 9 的路由語法
// Route::post('/update-booking-status', [BookingController::class, 'updateBookingStatus']);



Route::post('/batch-update-booking-status', [BookingController::class, 'batchUpdate'])->middleware('auth');;




//Mentee預約名單
Route::get('/getBookingsForMentee', [ClassScheduleController::class, 'getBookingsForMentee']);
Route::get('/getBookingsForMentor', [ClassScheduleController::class, 'getBookingsForMentor']);




// 當訪問/search時，調用SearchMentorController的index方法
Route::get('/search', [SearchMentorController::class, 'index'])->name('search.index');
Route::post('/getMentors', [SearchMentorController::class, 'getMentors'])->name('getMentors');





// 在 web.php
Route::get('/activate/{activationCode}', [ActivationController::class, 'activateAccount']);


Route::middleware(['auth', 'check.activated'])->group(function () {
    // 更新 mentee 的 profile 路由
    Route::post('/profile-settings-mentee', function (Request $request, AuthController $controller) {
        return $controller->updateProfile($request);
    });

    // 更新 mentor 的 profile 路由
    Route::post('/profile-settings-mentor', function (Request $request, AuthController $controller) {
        return $controller->updateProfile($request);
    });

    // 显示 mentor 的 profile settings 页面
    Route::get('/profile-settings-mentor', [AuthController::class, 'showProfileSettingsMentor']);

    // 显示 mentee 的 profile settings 页面
    Route::get('/profile-settings-mentee', [AuthController::class, 'showProfileSettingsMentee']);

    // Mentor 的 Dashboard 页面
    Route::get('/dashboard_mentor', [DashboardController::class, 'mentor_index'])
        ->middleware('role:mentor')
        ->name('dashboard_mentor');
});







// 註冊學員的POST 路由
Route::post('/mentee-register', [AuthController::class, 'menteeRegister']);

// 註冊學員的 GET 路由
Route::get('/mentee-register', function () {
    return view('mentee-register');
})->name('mentee-register');

Route::get('log-viewer', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index');



// 註冊導師的POST 路由
Route::post('/mentor-register', [AuthController::class, 'mentorRegister']);

// 註冊導師的 GET 路由
Route::get('/mentor-register', function () {
    return view('mentor-register');
})->name('mentor-register');






// 登入路由
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//登出
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





//激活碼
// Route::get('activate/{code}', 'Auth\ActivationController@activate');

//logviewer
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');



//Mentor_Bookings
Route::get('/bookings_mentor', function () {
    return view('bookings_mentor');
})->name('bookings_mentor');

Route::get('/mentee-list', function () {
    return view('mentee-list');
})->name('mentee-list');
Route::get('/profile-mentee', function () {
    return view('profile-mentee');
})->name('profile-mentee');

Route::get('/profile-settings', function () {
    return view('profile-settings');
})->name('profile-settings');
Route::get('/reviews', function () {
    return view('reviews');
})->name('reviews');




Route::get('/map-grid', function () {
    return view('map-grid');
})->name('map-grid');
Route::get('/map-list', function () {
    return view('map-list');
})->name('map-list');

Route::get('/bookings_mentee', function () {
    return view('bookings_mentee');
})->name('bookings_mentee');







Route::get('/blog-list', function () {
    return view('blog-list');
})->name('blog-list');


// 前端顯示所有的Blogs
Route::get('/blog-grid', [FrontBlogController::class, 'showBlog'])->name('blog-grid');
Route::get('/blogs', [FrontBlogController::class, 'apiShowBlogs'])->name('blogs');
Route::get('/blogs/latest', [FrontBlogController::class, 'latest'])->name('latest');

// 添加一个带参数的路由，用于获取特定博客的详情
Route::get('/blog-details/{id}', [FrontBlogController::class, 'showBlogDetails'])->name('blog-details');



/*****************ADMIN ROUTES*******************/

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CourseMaterialController;



Route::get('/show-mentor/{id}', [AdminController::class, 'showMentor'])->name('show.mentor');
Route::get('/show-mentee/{id}', [AdminController::class, 'showMentee'])->name('show.mentee');





//mentee , mentor 整合版
Route::post('toggle-activation/{id}', [AdminController::class, 'toggleActivation']);
//admin取得所有mentee,mentor
Route::get('/get-users/{role}', [AdminController::class, 'getUsersByRole']);

//所有課程
Route::get('/get-class-schedules', [AdminController::class, 'getClassSchedules']);

//儀表板功能 1104
Route::get('/counts', [AdminController::class, 'countEntities']);
// Route::get('/${role}/monthly-counts', [AdminController::class, 'getMonthlyMenteeCounts']);
Route::get('/{role}s/monthly-counts', [AdminController::class, 'getMonthlyCounts']);



//Admin 切換mentee的狀況
Route::post('change-mentee-status/{id}', [AdminController::class, 'changeStatus']);
//Admin 切換mentor的狀況
Route::post('change-mentor-status/{id}', [AdminController::class, 'changeStatus']);








// 添加這個路由來處理表單提交
Route::post('/update-website', [WebsiteController::class, 'update']);

// 對於不需要任何中間件的路由，Admin登入
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin-login');
Route::post('/admin/ajax-login', [AdminController::class, 'ajaxLogin'])->name('ajax-login');
// 在 routes/web.php 或 routes/api.php
Route::get('translations', [TranslationController::class, 'index']);






//admin註冊頁面
Route::get('/admin/register', [AdminController::class, 'register'])->name('register');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.submit');
Route::post('/admin/change-password', [AdminController::class, 'changePassword']);
Route::post('/admin/update-profile', [AdminController::class, 'updateProfile']);




//需要中間路由 Admin開頭
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    //Admin登出
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin-logout');
    //Admin的簡介
    Route::get('/profile/{id}', [AdminController::class, 'profile'])->name('adminprofile');

    Route::get('/transactions-list', [OrderPlanController::class, 'transactionsList'])->name('transactions-list');
    // 在 routes/web.php 中
    Route::post('/update-order-status', [OrderPlanController::class, 'updateStatus'])->name('update-order-status');




    // 使用資源路由而不是單獨的路由
    Route::resource('blog', BlogController::class)->names([
        'index' => 'admin.blog',
        'create' => 'admin.create-blog',
        'store' => 'admin.add-blog',
        'show' => 'admin.blog.show',
        'edit' => 'admin.edit-blog',
        'update' => 'admin.blog.update',
        'destroy' => 'admin.blog.destroy',
    ]);



//Admin底下
    Route::get('/index_admin', [AdminController::class, 'indexAdmin'])->name('page');
    Route::get('/mentor', [AdminController::class, 'mentor'])->name('mentor');
    Route::get('/mentee', [AdminController::class, 'mentee'])->name('mentee');
    Route::get('/booking-list', [AdminController::class, 'bookingList'])->name('booking-list');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::get('/invoice-report', [AdminController::class, 'invoiceReport'])->name('invoice-report');
    Route::get('/ledger-search', [AdminController::class, 'searchLedger'])->name('ledger-search');
    Route::post('/update-rate/{id}', [AdminController::class, 'updateRate']);
    Route::post('/unpaidchange/{id}', [AdminController::class, 'unpaidChange'])->name('unpaidchange');









    Route::get('/forgot-password', [AdminController::class, 'forgotPassword'])->name('forgot-password');
    Route::get('/lock-screen', [AdminController::class, 'lockScreen'])->name('lock-screen');
    Route::get('/error-404', [AdminController::class, 'error404'])->name('error-404');
    Route::get('/error-500', [AdminController::class, 'error500'])->name('error-500');
    Route::get('/blank-page', [AdminController::class, 'blankPage'])->name('blank-page');
    Route::get('/components', [AdminController::class, 'components'])->name('components');
    Route::get('/form-basic-inputs', [AdminController::class, 'formBasicInputs'])->name('form-basic-inputs');
    Route::get('/form-input-groups', [AdminController::class, 'formInputGroups'])->name('form-input-groups');
    Route::get('/form-horizontal', [AdminController::class, 'formHorizontal'])->name('form-horizontal');
    Route::get('/form-vertical', [AdminController::class, 'formVertical'])->name('form-vertical');
    Route::get('/form-mask', [AdminController::class, 'formMask'])->name('form-mask');
    Route::get('/form-validation', [AdminController::class, 'formValidation'])->name('form-validation');
    Route::get('/tables-basic', [AdminController::class, 'tablesBasic'])->name('tables-basic');
    Route::get('/data-tables', [AdminController::class, 'dataTables'])->name('data-tables');
    Route::get('/invoice', [AdminController::class, 'invoice'])->name('invoice');
});

/********************ADMIN ROUTES END******************************/

// 密碼重置路由
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

// 作文系統路由
Route::middleware(['auth'])->group(function () {
    Route::resource('essays', EssayController::class)->except(['show']);
    Route::get('/essays/history', [EssayController::class, 'history'])->name('essays.history');
    Route::get('/essays/{essay}', [EssayController::class, 'show'])->name('essays.show');
});

Route::get('/debug-locale', function () {
    return response()->json([
        'current_locale' => app()->getLocale(),
        'session_locale' => session('applocale'),
        'browser_languages' => request()->getLanguages(),
        'accept_language' => request()->header('Accept-Language'),
        'all_locales' => config('app.available_locales'),
    ]);
});

Route::get('/debug-language', function () {
    return response()->json([
        'app_locale' => app()->getLocale(),
        'session_locale' => session()->get('locale'),
        'available_locales' => config('app.available_locales', []),
        'headers' => request()->header(),
        'accept_languages' => request()->getLanguages()
    ]);
});



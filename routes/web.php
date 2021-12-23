<?php

use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Restraunt\Dashboard;
use App\Http\Livewire\Restraunt\Menu as RestrauntMenu;
use App\Http\Livewire\Signup;
use App\Http\Livewire\Signin;
use App\Mail\TestMail;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use hisorange\BrowserDetect\Parser as Browser;
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
//create a symlink to storage folder
Route::get('/storage-link', function() {
    Artisan::call('storage:link');
    return redirect('/');
});
 Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 });

 Route::get('/view-clear', function() {
     $exitCode = Artisan::call('view:clear');
     return 'View cache cleared';
 });

Route::get('/test-email', function () {
    return Mail::to('cleoctech@gmail.com')
    ->send(new TestMail());
});
Route::get('/ip-address', function () {
    $macAddr = exec('getmac');
    if (\Browser::isMobile()) {
        echo "Mobile";
    } else if(\Browser::isTablet()){
        echo "Tablet";
    } else if (\Browser::isDesktop()){
        echo "Desktop";
    } else if (\Browser::isBot()){
        echo "Bot";
    }

    dump(\Browser::platformName());
    dump(\Browser::browserName());
    dump(\Browser::userAgent());
    dd($macAddr);
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    // return $ipaddress;
    // $clientIP = \Request::getClientIp(true);

    dd($ipaddress);
});


//Route::post('upload', [App\Http\Controllers\UploadController::class, 'store'])->name('upload');
Route::get('/', Signup::class)->name('signup');
// Route::get('/r/signin', Signin::class)->name('signin');
Route::get('/r/verify-email/{token}', [App\Http\Controllers\VerifyEmailController::class, 'setpass'])->name('verify-mail');
Route::post('/r/set-password/{token}', [App\Http\Controllers\VerifyEmailController::class, 'verify'])->name('set-password');

Route::get('/r/signin',  [App\Http\Controllers\Auth\LoginController::class, 'resSgnin'])->name('restraunt-signin');
Route::post('/r/signin',  [App\Http\Controllers\Auth\LoginController::class, 'resAuth'])->name('restraunt-auth');
Route::get('/r/password/reset/{token}/{email}',  [App\Http\Controllers\Auth\PasswordRecoveryController::class, 'showResetForm'])->name('r-password-rest');
Route::post('/r/password/email',  [App\Http\Controllers\Auth\PasswordRecoveryController::class, 'sendResetLinkEmail'])->name('r-password-email');
Route::get('/r/password/forget',  [App\Http\Controllers\Auth\PasswordRecoveryController::class, 'showForgetForm'])->name('r-password-forget');
Route::post('/r/password/update',  [App\Http\Controllers\Auth\PasswordRecoveryController::class, 'reset'])->name('r-password-update');

Route::get('/admin/password/forget',  [App\Http\Controllers\Auth\PasswordRecoveryController::class, 'showForgetFormAdmin'])->name('admin-password-forget');
Route::post('/admin/password/email',  [App\Http\Controllers\Auth\PasswordRecoveryController::class, 'sendResetLinkEmail'])->name('admin-password-email');
Route::get('/admin/password/reset/{token}/{email}',  [App\Http\Controllers\Auth\PasswordRecoveryController::class, 'showResetFormAdmin'])->name('admin-password-rest');
Route::post('/admin/password/update',  [App\Http\Controllers\Auth\PasswordRecoveryController::class, 'resetAdmin'])->name('admin-password-update');


Route::get('admin/signin',  [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin-signin');
Route::post('admin/signin',  [App\Http\Controllers\Auth\LoginController::class, 'adminAuth'])->name('admin-auth');

Route::get('admin/signup',  [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm'])->name('admin-signup');
Route::post('admin/signup',  [App\Http\Controllers\Auth\RegisterController::class, 'createAdmin'])->name('admin-signup');

Route::get('/r/{restaurant}/{table}', RestrauntMenu::class)->name('res-menu');
//http://127.0.0.1:8000/r/Et_aut_voluptatem_es675810/Front_Table_4839930
Route::get('/login', function () {
    return redirect()->route('admin-signup');
})->name('login');

Route::get('register', function () {
    return redirect()->route('admin-register');
});

Auth::routes();
Route::redirect('login', 'admin/signup');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth:restraunt'], function () {
    Route::get('/r/{code}', Dashboard::class)->name('r-dashboard');
    Route::post('upload', [\App\Http\Controllers\UploadController::class, 'store']);
    Route::post('destroy', [\App\Http\Controllers\UploadController::class, 'destroy']);
});

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin-dashboard');
});

Route::get('logout', [LoginController::class,'logout']);


Route::get('qr-code-g', function () {

    \QrCode::size(500)
            ->format('png')
           ->generate('wenlasystems.com', storage_path('qrcode.png'));

    return view('qr-code');
});
<?php

use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Restraunt\Dashboard;
use App\Http\Livewire\Restraunt\Menu as RestrauntMenu;
use App\Http\Livewire\Signup;
use App\Http\Livewire\Signin;
use App\Mail\TestMail;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;


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
    return new TestMail();
});

Route::get('/', Signup::class)->name('signup');
// Route::get('/r/signin', Signin::class)->name('signin');
Route::get('/r/verify-email/{token}', [App\Http\Controllers\VerifyEmailController::class, 'setpass'])->name('verify-mail');
Route::post('/r/set-password/{token}', [App\Http\Controllers\VerifyEmailController::class, 'verify'])->name('set-password');

Route::get('/r/signin',  [App\Http\Controllers\Auth\LoginController::class, 'resSgnin'])->name('restraunt-signin');
Route::post('/r/signin',  [App\Http\Controllers\Auth\LoginController::class, 'resAuth'])->name('restraunt-auth');

Route::get('admin/signin',  [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin-signin');
Route::post('admin/signin',  [App\Http\Controllers\Auth\LoginController::class, 'adminAuth'])->name('admin-auth');

Route::get('admin/signup',  [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm'])->name('admin-signup');
Route::post('admin/signup',  [App\Http\Controllers\Auth\RegisterController::class, 'createAdmin'])->name('admin-signup');

Route::get('/r/{restaurant}/{table}', RestrauntMenu::class)->name('res-menu');

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
});

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin-dashboard');
});

Route::get('logout', [LoginController::class,'logout']);


Route::get('qr-code-g', function () {

    \QrCode::size(500)
            ->format('png')
           ->generate('wenlasoftwares.com', storage_path('qrcode.png'));

  return view('qr-code');
});
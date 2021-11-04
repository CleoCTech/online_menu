<?php

use App\Http\Livewire\Restraunt\Dashboard;
use App\Http\Livewire\Signup;
use App\Http\Livewire\Signin;
use App\Mail\TestMail;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
Route::get('/r/verify-email/{token}', [App\Http\Controllers\VerifyEmailController::class, 'setpass'])->name('verify-mail');
Route::post('/r/set-password/{token}', [App\Http\Controllers\VerifyEmailController::class, 'verify'])->name('set-password');
Route::get('/r/restraunt-signin',  [App\Http\Controllers\Auth\LoginController::class, 'resSgnin'])->name('restraunt-signin');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/r/{code}', [App\Http\Controllers\VerifyEmailController::class, 'completesetup'])->name('complete-setup');
Route::get('/r/{code}', Dashboard::class)->name('r-dashboard');


Route::get('qr-code-g', function () {

    \QrCode::size(500)
            ->format('png')
           ->generate('wenlasoftwares.com', storage_path('qrcode.png'));

  return view('qr-code');
});

Route::get('app-url', function () {

  echo  env('APP_URL');

});
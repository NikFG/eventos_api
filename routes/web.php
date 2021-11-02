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

Route::get('/', function () {
    return view('welcome');
});

Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('envio', function () {
    $user = new stdClass();
    $user->nome = 'Nikollas';
    $user->email = 'nikollasferreirag@gmail.com';
//    $user->email = '2nightjr@gmail.com';
//    return new \App\Mail\EnvioEmail($user);
    \App\Jobs\EnvioEmail::dispatch($user)->delay(now()->addSeconds('3'));
});

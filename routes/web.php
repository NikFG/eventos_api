<?php

use App\Http\Controllers\VerificationController;
use App\Mail\EnvioEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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

Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//certificado route with certicidao view
Route::get('/certificado', function () {
    $user = User::find(2);
//    Mail::send(new EnvioEmail($user, 'loucura', ''));
    $pdf = PDF::loadView('certificado', [
        'nome_aluno' => 'Joao',
        'cidade' => 'PHPlandia',
        'nome_atividade' => 'PHP',
        'data' => '01/01/2020',
        'horas' => '10',
        'dia' => '02',
        'mes' => 'Janeiro',
        'ano' => '2020',
        'titulo' => 'Certificado de Conclusao de Curso',
    ]);
    return $pdf->download('teste.pdf');

    return view('certificado', [
        'nome_aluno' => 'Joao',
        'cidade' => 'PHPlandia',
        'nome_atividade' => 'PHP',
        'data' => '01/01/2020',
        'horas' => '10',
        'dia' => '02',
        'mes' => 'Janeiro',
        'ano' => '2020',
        'titulo' => 'Certificado de Conclusao de Curso',
    ]);
})->name('certificado');


<?php

use App\Http\Controllers\VerificationController;
use App\Mail\EnvioEmail;
use App\Models\Atividade;
use App\Models\Certificado;
use App\Models\Instituicao;
use App\Models\ModeloCertificado;
use App\Models\User;
use Carbon\Carbon;
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
    $user = User::findOrFail(1);
    $c = Certificado::findOrFail(1);
//    Mail::send(new EnvioEmail($user, 'loucura', ''));

    $modelo = ModeloCertificado::find($c->modelo_certificado_id);
    $atividade = Atividade::find($c->atividade_id);
    $instituicao = Instituicao::find($c->instituicao_id);

    $data = Carbon::parse($c->data_emissao)->formatLocalized('%d de %B de %Y');
    $pdf = PDF::loadView('certificado', [
        'certificado' => $c,
        'modelo' => $modelo,
        'participante' => $user,
        'atividade' => $atividade,
        'instituicao' => $instituicao,
        'data' => $data,

    ])->setPaper('a4', 'landscape')->setWarnings(false);
  return  $pdf->download('teste.pdf');

    return view('certificado',[
        'certificado' => $c,
        'modelo' => $modelo,
        'participante' => $user,
        'atividade' => $atividade,
        'instituicao' => $instituicao,
        'data' => $data,

    ]);
})->name('certificado');


<?php

use App\Http\Controllers\VerificationController;
use App\Models\Atividade;
use App\Models\Certificado;
use App\Models\Instituicao;
use App\Models\ModeloCertificado;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
//Permissões
    /* $usuario = Role::create(['name' => 'usuario', 'guard_name' => 'api']);
    $associado = Role::create(['name' => 'associado', 'guard_name' => 'api']);
    $admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
    $superadmin = Role::create(['name' => 'super-admin', 'guard_name' => 'api']);

    $g_usuario = Permission::create(['name' => 'gerenciar_usuario', 'guard_name' => 'api']);

    $v_certificado = Permission::create(['name' => 'visualizar_certificado', 'guard_name' => 'api']);
    $g_certificado = Permission::create(['name' => 'gerenciar_certificado', 'guard_name' => 'api']);

    $e_evento = Permission::create(['name' => 'entrar_evento', 'guard_name' => 'api']);
    $g_evento = Permission::create(['name' => 'gerenciar_evento', 'guard_name' => 'api']);

    $c_instituicao = Permission::create(['name' => 'cadastrar_instituicao', 'guard_name' => 'api']);
    $g_instituicao = Permission::create(['name' => 'gerenciar_instituicao', 'guard_name' => 'api']);

    $usuario->givePermissionTo($g_usuario);
    $usuario->givePermissionTo($v_certificado);
    $usuario->givePermissionTo($e_evento);
    $usuario->givePermissionTo($c_instituicao);

    $associado->givePermissionTo($g_usuario);
    $associado->givePermissionTo($v_certificado);
    $associado->givePermissionTo($e_evento);
    $associado->givePermissionTo($c_instituicao);
    $associado->givePermissionTo($g_certificado);
    $associado->givePermissionTo($g_evento);

    $admin->givePermissionTo($g_usuario);
    $admin->givePermissionTo($v_certificado);
    $admin->givePermissionTo($e_evento);
    $admin->givePermissionTo($c_instituicao);
    $admin->givePermissionTo($g_certificado);
    $admin->givePermissionTo($g_evento);
    $admin->givePermissionTo($g_instituicao);

    $c = new \App\Models\Categoria();
    $c->nome = 'teste';
    $c->save();

    $ti = new \App\Models\TipoImagem();
    $ti->nome = "teste";
    $ti->save();

    $ti = new \App\Models\TipoImagem();
    $ti->nome = "teste2";
    $ti->save();

    $ta = new \App\Models\TipoAtividade();
    $ta->nome = "teste";
    $ta->save();

    $te = new \App\Models\TipoEvento();
    $te->nome = "teste";
    $te->save();
    $user = User::find(1);
    $user->assignRole('super-admin');*/

    return view('welcome');
});

Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

//certificado route with certicidao view
Route::get('/certificado', function () {

    $user = User::findOrFail(1);
    $c    = Certificado::findOrFail(1);
//    Mail::send(new EnvioEmail($user, 'loucura', ''));

    $modelo      = ModeloCertificado::find(10);
    $atividade   = Atividade::find($c->atividade_id);
    $instituicao = Instituicao::find($c->instituicao_id);
    $nome        = 'aaaaaa';

    Carbon::setLocale('pt_BR');
    $data = Carbon::parse($c->data_emissao)->translatedFormat('d')
    . " de " . Carbon::parse($c->data_emissao)->translatedFormat('F')
    . " de " . Carbon::parse($c->data_emissao)->translatedFormat('Y');
    return view('certificado', [
        'certificado'  => $c,
        'modelo'       => $modelo,
        'nome'         => $nome,
        'atividade'    => $atividade,
        'instituicao'  => $instituicao,
        'data'         => $data,
        'verifica_url' => env('HOME_APLICACAO') . '/certificado/verificar',

    ]);
    $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadView('certificado', [
            'certificado'  => $c,
            'modelo'       => $modelo,
            'nome'         => $nome,
            'atividade'    => $atividade,
            'instituicao'  => $instituicao,
            'data'         => $data,
            'verifica_url' => env('HOME_APLICACAO') . '/certificado/verificar',

        ])->setPaper('a4', 'landscape')->setWarnings(false);
//    $arquivo = $pdf->output();
//    $arquivo2 = $pdf->stream('aaaa.pdf');
//    return $arquivo2;
//    $this->attachData($arquivo, 'certificado.pdf');
    \Illuminate\Support\Facades\Storage::disk('local')->put('certificado.pdf', $arquivo);
//    return $pdf->download('teste.pdf');
//    return $pdf->stream('certificado.pdf');

});

<?php

use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ModeloCertificadoController;
use App\Http\Controllers\TipoAtividadeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(["prefix" => "eventos"], function () {
    Route::get("/", [EventoController::class, 'index']);
    Route::get("/{id}", [EventoController::class, 'show'])->where('id', '[0-9]+');
    Route::get("/categorias/{id}", [EventoController::class, 'porCategoria'])->where('id', '[0-9]+');;

    Route::get('/user', [EventoController::class, 'eventos_participados'])->middleware('role:usuario');
    Route::post("/ingressos", [EventoController::class, 'compraIngresso'])->middleware('role:usuario');
    Route::get('/{id}/user/atividades', [EventoController::class, 'atividades_participadas'])->middleware('role:usuario');

    Route::get("/criados", [EventoController::class, 'eventos_criados'])->can('gerenciar_evento');
    Route::post("/store", [EventoController::class, 'store'])->can('gerenciar_evento');
    Route::post("/update/{id}", [EventoController::class, 'update'])->can('gerenciar_evento');

});

Route::group(["prefix" => "categorias"], function () {
    Route::get("/", [CategoriaController::class, 'index']);
});


Route::group(["prefix" => "user"], function () {

    Route::post("/register", [UserController::class, 'store']);
    Route::post("/login", [AuthController::class, 'login']);
    Route::post("/logout", [AuthController::class, 'logout'])->middleware('role:usuario');;

});
Route::group(["prefix" => "instituicao"], function () {
    Route::get('/', [InstituicaoController::class, 'index']);
    Route::post("/store", [InstituicaoController::class, 'store'])->middleware('role:usuario');
    Route::post("/addUsuario/{id}", [InstituicaoController::class, 'addUsuario'])->can('cadastrar_instituicao');
});

Route::group(["prefix" => "tipoAtividades"], function () {
    Route::get("/", [TipoAtividadeController::class, 'index']);
});


Route::group(["prefix" => "atividades"], function () {
    Route::get('/', [AtividadeController::class, 'index']);
    Route::get('/{id}', [AtividadeController::class, 'show']);
});


Route::group(["prefix" => "certificados", "middleware" => "role:usuario"], function () {
    Route::get('/', [CertificadoController::class, 'index']);
    Route::get('/{id}', [CertificadoController::class, 'show'])->where('id', '[0-9]+');;
    Route::post('/atividade/{id}', [CertificadoController::class, 'store'])->can('gerenciar_certificado');
    Route::post('/{id}/gerar', [CertificadoController::class, 'gerarCertificado'])->where('id', '[0-9]+');;
});


Route::group(["prefix" => "modelos"], function () {
    Route::post('/store', [ModeloCertificadoController::class, 'store']);
});


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

Route::group(["prefix" => "eventos"], function () {
    Route::get("/", [EventoController::class, 'index']);
    Route::get("/{id}", [EventoController::class, 'show'])->where('id', '[0-9]+');
    Route::get("/categorias/{id}", [EventoController::class, 'porCategoria'])->where('id', '[0-9]+');

    Route::get('/user', [EventoController::class, 'eventos_participados'])->middleware('role:usuario');
    Route::post("/ingressos", [EventoController::class, 'compraIngresso'])->middleware('role:usuario');
    Route::get('/{id}/user/atividades', [EventoController::class, 'atividades_participadas'])->middleware('role:usuario');

    Route::get("/criados", [EventoController::class, 'eventos_criados'])->can('gerenciar_evento');
    Route::post("/store", [EventoController::class, 'store'])->can('gerenciar_evento');
    Route::post("/update/{id}", [EventoController::class, 'update'])->can('gerenciar_evento');
    Route::delete("/{id}", [EventoController::class, 'destroy'])->can('gerenciar_evento');
    Route::post("/{id}/uploadImagens", [EventoController::class, 'upload_imagens'])->can('gerenciar_evento')->where('id', '[0-9]+');
});

Route::group(["prefix" => "categorias"], function () {
    Route::get("/", [CategoriaController::class, 'index']);
});

Route::group(["prefix" => "user"], function () {

    Route::post("/register", [UserController::class, 'store']);
    Route::post("/login", [AuthController::class, 'login']);
    Route::post('/checkauth', [AuthController::class, 'checkAuth']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::post('/update/{id}', [UserController::class, 'update'])->middleware('role:usuario')->where('id', '[0-9]+');
    Route::post("/logout", [AuthController::class, 'logout'])->middleware('role:usuario');
    Route::get('/fromToken', [UserController::class, 'fromToken'])->middleware('role:usuario');
});

Route::group(["prefix" => "instituicao"], function () {
    Route::get('/', [InstituicaoController::class, 'index']);
    Route::get('/user', [InstituicaoController::class, 'showByUser'])->can('gerenciar_instituicao');
    Route::post("/store", [InstituicaoController::class, 'store'])->middleware('role:usuario');

    Route::post("/update/{id}", [InstituicaoController::class, 'update'])->middleware('role:admin')->where('id', '[0-9]+');
    Route::post("/transferir", [InstituicaoController::class, 'transferirAdmin'])->middleware('role:admin');

    Route::get('/associados', [InstituicaoController::class, 'getAssociados'])->middleware('role:admin');
    Route::post("/associados", [InstituicaoController::class, 'addAssociado'])->can('cadastrar_instituicao');
    Route::delete("/associados/{email}", [InstituicaoController::class, 'deleteAssociado'])->middleware('role:admin');

});

Route::group(["prefix" => "tipoAtividades"], function () {
    Route::get("/", [TipoAtividadeController::class, 'index']);
});

Route::group(["prefix" => "atividades"], function () {
    Route::get('/', [AtividadeController::class, 'index']);
    Route::get('/{id}', [AtividadeController::class, 'show']);
    Route::get('/participantes/{id}', [AtividadeController::class, 'participantesApresentadores'])->where('id', '[0-9]+');
});

Route::group(["prefix" => "certificados"], function () {
    Route::get('/', [CertificadoController::class, 'index'])->middleware('role:usuario');
    Route::get('/{id}', [CertificadoController::class, 'show'])->where('id', '[0-9]+')->middleware('role:usuario');
    Route::post('/atividade/{id}', [CertificadoController::class, 'store'])->can('gerenciar_certificado');
    Route::post('/{id}/gerar', [CertificadoController::class, 'gerarCertificado'])->where('id', '[0-9]+'); //->middleware('role:usuario');
    Route::post('/{id}/gerarByAtividade', [CertificadoController::class, 'gerarCertificadoByUserAtividade'])->where('id', '[0-9]+')->middleware('role:usuario');
    Route::post('/verificar', [CertificadoController::class, 'verificaCertificado']);
    Route::get('/{id}/download', [CertificadoController::class, 'geraLinkCertificado'])->where('id', '[0-9]+')->middleware('role:usuario');
});

Route::group(["prefix" => "modelos"], function () {
    Route::get('/', [ModeloCertificadoController::class, 'index']);
    Route::get('/instituicao/{id}', [ModeloCertificadoController::class, 'indexByInstituicao']);
    Route::post('/store', [ModeloCertificadoController::class, 'store'])->can('gerenciar_certificado');
    Route::post('/uploadImagens/{id}', [ModeloCertificadoController::class, 'uploadImagens'])->can('gerenciar_certificado')->where('id', '[0-9]+');
});

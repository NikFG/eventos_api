<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InstituicaoController;
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
    Route::get("/{id}", [EventoController::class, 'show'])->where('id', '[0-9]+');;
    Route::get("/criados", [EventoController::class, 'eventos_criados']);
    Route::get("/categorias/{id}", [EventoController::class, 'porCategoria'])->where('id', '[0-9]+');;
    Route::get('/user', [EventoController::class, 'eventos_participados']);
    Route::get('/{id}/user/atividades', [EventoController::class, 'atividades_participadas']);

    Route::post("/store", [EventoController::class, 'store']);
    Route::post("/ingressos", [EventoController::class, 'compraIngresso']);
    Route::post("/update/{id}", [EventoController::class, 'update']);

});

Route::group(["prefix" => "categorias"], function () {
    Route::get("/", [CategoriaController::class, 'index']);
});


Route::group(["prefix" => "user"], function () {

    Route::post("/register", [UserController::class, 'store']);
    Route::post("/login", [AuthController::class, 'login']);

});
Route::group(["prefix" => "instituicao"], function () {
    Route::get('/',[InstituicaoController::class,'index']);
    Route::post("/store", [InstituicaoController::class, 'store']);
});

Route::group(["prefix" => "tipoAtividades"], function () {
    Route::get("/", [TipoAtividadeController::class, 'index']);
});

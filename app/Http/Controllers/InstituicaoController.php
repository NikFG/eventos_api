<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstituicaoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $instituicoes = Instituicao::all();
        return response()->json($instituicoes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'max:200', 'min:3'],
            'cnpj' => ['required', 'cnpj', 'unique:instituicoes'],
            'endereco' => ['required', 'max:500', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $instituicao = new Instituicao();

        $instituicao->nome = $request->nome;
        $instituicao->cnpj = $request->cnpj;
        $instituicao->endereco = $request->endereco;
        $instituicao->logo = "";//$request->logo;
        $instituicao->administrador()->associate($user->id);
        $instituicao->save();
        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}

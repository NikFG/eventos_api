<?php

namespace App\Http\Controllers;

use App\Models\Apresentador;
use App\Models\Atividade;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AtividadeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $atividades = Atividade::all();
        return response()->json($atividades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $atividade = Atividade::find($id);
//            ->find($id);
        return response()->json($atividade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    public function participantesApresentadores(int $id) {
        $participantes = User::join('participante_atividades', 'users.id', '=', 'participante_atividades.user_id')
            ->where('participante_atividades.atividade_id', $id)
            ->where('apresentador_id', null)
            ->get(['users.id', 'users.nome', 'email']);

        $apresentadores = Apresentador::join('participante_atividades', 'apresentadores.id', '=', 'participante_atividades.apresentador_id')
            ->where('participante_atividades.atividade_id', $id)
            ->get(['apresentadores.id', 'nome', 'email', 'apresentadores.user_id']);
        $instituicao = Atividade::find($id)->evento->instituicao_id;
        return response()->json(['participantes' => $participantes, 'apresentadores' => $apresentadores, 'instituicao' => $instituicao]);

    }


}

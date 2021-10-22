<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Certificado;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CertificadoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $user = Auth::user();
        $certificados = Certificado::where('participante_id',$user->id)->get();
        return response()->json($certificados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function store(Request $request, int $id): JsonResponse {
        $a = Atividade::with('evento')->find($id);
        $participantes = json_decode($request->participantes);
        $horario_inicio = Carbon::parse($a->horario_inicio);
        $horario_fim = Carbon::parse($a->horario_fim);
        $horas = $horario_fim->diffInHours($horario_inicio);
        try {
            DB::transaction(function () use ($horas, $a, $participantes) {
                foreach ($participantes as $p) {
                    $data = Carbon::now();
                    $c = new Certificado();
                    $c->descricao = $a->nome;
                    $c->data_emissao = $data->toDateString();
                    $c->nome_evento = $a->evento->nome;
                    $c->local = $a->local;
                    $c->horas = $horas;
                    $c->participante()->associate($p);
                    $c->evento()->associate($a->evento_id);
                    $c->instituicao()->associate($a->evento->instituicao_id);
                    $c->atividade()->associate($a->id);
                    $c->codigo_verificacao = Hash::make($a->id . '-' . $p);
                    if ($c->save()) {
                        $a->users()->updateExistingPivot($p, ['participou' => true]);
                    }
                }
            });
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e, 500);
        }
        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $user = Auth::user();
        $c = Certificado::find($id);
        return response()->json($c);
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

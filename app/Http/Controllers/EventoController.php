<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Evento;
use App\Models\ParticipanteAtividade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class EventoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])->with('imagens')->with('categoria')->whereHas('atividades')->get();
        return response()->json($eventos);
    }

    public function porCategoria($id): JsonResponse {
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])->with('imagens')->with('categoria')->whereRelation('categoria', 'id', '=', $id)->get();
        return response()->json($eventos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $e = new Evento();
        $e->nome = $request->nome;
        $e->breve_descricao = $request->breve_descricao;
        $e->expectativa_participantes = $request->expectativa_participantes;
        $e->link_evento = $request->link_evento;
        $e->local = $request->local;
        $e->descricao = $request->descricao;
        $e->tipo_id = 1;
        $e->instituicao_id = 4;
        $e->categoria()->associate($request->categoria_id);
        $e->user()->associate(2);
        $e->save();

        //criar atividades
        $atividades = json_decode($request->atividades);
        foreach ($atividades as $atv) {
            $a = new Atividade();
            $a->nome = $atv->nome;
            $a->data = $atv->data;
            $a->horario_inicio = $atv->horario_inicio;
            $a->horario_fim = $atv->horario_fim;
            $a->tipo_atividade()->associate($atv->tipo_atividade);
            $a->evento()->associate($e->id);
            $a->save();
        }


        return response()->json($atividades, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse {
        $evento = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])->find($id);
        return response()->json($evento);
    }

    public function search($query): JsonResponse {

        $unwanted_array = array('Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y');

        $str = strtr($query, $unwanted_array);
        $queryLower = trim(strtolower($str));
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])
            ->where(DB::raw('lower(nome)'), 'like', '%' . $queryLower . '%')
            ->orWhere(DB::raw('lower(breve_descricao)'), 'like', '%' . $queryLower . '%')
            ->orWhereHas('categoria', function ($q) use ($queryLower) {
                $q->where(DB::raw('lower(categorias.nome)'), 'like', '%' . $queryLower . '%');
            })
            ->get();
        return response()->json($eventos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id) {
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

    public function compraIngresso(Request $request) {
        $user = Auth::user();
        $atividades_id = json_decode($request->atividades);
        foreach ($atividades_id as $id) {

            $pa = new ParticipanteAtividade();
            $pa->atividade_id = $id;
            $pa->user_id = $user->id;
            $pa->save();
        }

        return response()->json(["Ok"], 201);
    }

    public function eventos_criados(): JsonResponse {
        $user = Auth::user();
        $eventos = Evento::with('atividades')->where('user_id', $user->id)->get();

        return response()->json($eventos);
    }
    public function atividades_participadas(): JsonResponse {
        $user = Auth::user();
        $atividades = Evento::whereHas('atividades', function (Builder $query) use ($user) {
            $query->whereRelation('users', 'users.id', $user->id)->with('users');
        })
            ->with('atividades')
            ->get();
        return response()->json($atividades);
    }
}

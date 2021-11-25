<?php

namespace App\Http\Controllers;

use App\Models\Apresentador;
use App\Models\Atividade;
use App\Models\Evento;
use App\Models\Imagem;
use App\Models\Instituicao;
use App\Models\ParticipanteAtividade;
use App\Models\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventoController extends Controller {


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse {
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])
            ->with('categoria')
            ->whereHas('atividades')
            ->with('instituicao')
            ->orderBy('created_at', 'desc');

        if ($request->q != null) {
            $queryLower = trim(strtolower($request->q));
            $eventos->where(function ($query) use ($queryLower) {
                $query->where(DB::raw('lower(nome)'), 'like', '%' . $queryLower . '%')
                    ->orWhere(DB::raw('lower(breve_descricao)'), 'like', '%' . $queryLower . '%');
            });
        }

        if ($request->cat != null) {
            $eventos->whereRelation('categoria', 'categorias.id', '=', $request->cat);
        }

        if ($request->instituicao != null) {
            $eventos->whereRelation('instituicao', 'instituicoes.id', $request->instituicao);
        }

        if ($request->dataInicio != null) {
            if ($request->dataFim != null) {
                $eventos->whereHas('atividades', function ($q) use ($request) {
                    $q->whereBetween('data', [$request->dataInicio, $request->dataFim]);
                });
            } else {
                $eventos->whereRelation('atividades', 'atividades.data', $request->dataInicio);
            }
        }

        if ($request->horarioInicio != null) {
            $eventos->whereTime('', '', '');
            $eventos->whereHas('atividades', function ($q) use ($request) {
                $q->whereTime('atividades.horario_inicio', '>=', $request->horarioInicio);
            });
        }

        if ($request->horarioFim != null) {
            $eventos->whereTime('', '', '');
            $eventos->whereHas('atividades', function ($q) use ($request) {
                $q->whereTime('atividades.horario_fim', '<=', $request->horarioFim);
            });
        }


        /* foreach ($eventos as $e) {
             if ($e->banner != null) {
                 try {
                     $e->banner = base64_encode(Storage::get($e->banner));
                 } catch (FileNotFoundException $error) {
                     return response()->json(null, 500);
                 }
             }
         }*/
        //        $eventos = $eventos->paginate(10);
        return response()->json($eventos->get());
    }

    public function porCategoria($id): JsonResponse {
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])->with('imagens')->with('categoria')
            ->whereRelation('categoria', 'id', '=', $id)
            ->whereHas('atividades')
            ->with('instituicao')
            ->get();
        return response()->json($eventos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws FileNotFoundException
     */
    public function store(Request $request): JsonResponse {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'min:10', 'max:100'],
            'expectativa_participantes' => ['required', 'integer'],
            'link_evento' => ['max:100', 'nullable'],
            'breve_descricao' => ['required', 'string', 'max:100'],
            'local' => ['nullable', 'max:500'],
            'descricao' => ['nullable'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'banner' => ['required', 'image'],
            'atividades' => ['required'],
            'atividades.*.nome' => ['required', 'max:255'],
            'atividades.*.data' => ['required', 'date', 'after:today'],
            'atividades.*.horario_inicio' => ['required', 'date_format:H:i'],
            'atividades.*.horario_fim' => ['required', 'date_format:H:i', 'after:atividades.*.horario_inicio'],
            'atividades.*.local' => ['nullable', 'max:200'],
            'atividades.*.link_tranmissao' => ['nullable', 'max:400'],
            'atividades.*.descricao' => ['nullable'],
            'atividades.*.tipo_atividade_id' => ['required', 'exists:tipo_atividades,id'],
            'atividades.*.apresentadores' => ['required'],
            'atividades.*.apresentadores.*.nome' => ['required', 'max:100', 'min:3', 'string'],
            'atividades.*.apresentadores.*.email' => ['required', 'email', 'max:100'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::transaction(function () use ($user, $request) {
            $instituicao = Instituicao::whereRelation('administrador', 'id', $user->id)->first();
            $e = new Evento();
            $e->nome = $request->nome;
            $e->breve_descricao = $request->breve_descricao;
            $e->expectativa_participantes = $request->expectativa_participantes;
            $e->link_evento = $request->link_evento;
            $e->local = $request->local;
            $e->descricao = $request->descricao;
            $e->tipo_id = 1;
            $e->instituicao_id = $instituicao->id;
            $e->link_evento = '';
            $e->categoria()->associate($request->categoria_id);
            $e->user()->associate($user->id);
            $e->save();


            //criar atividades
            $atividades = json_decode($request->atividades);

            foreach ($atividades as $atv) {
                $a = new Atividade();
                $a->nome = $atv->nome;
                $a->data = $atv->data;
                $a->horario_inicio = $atv->horario_inicio;
                $a->horario_fim = $atv->horario_fim;
                $a->descricao = $atv->descricao;
                $a->local = $atv->local;
                $a->tipo_atividade()->associate($atv->tipo_atividade_id);
                $a->evento()->associate($e->id);
                $a->save();
                foreach ($atv->apresentadores as $apresentador) {
                    $apr = new Apresentador();
                    $apr->nome = $apresentador->nome;
                    $apr->email = $apresentador->email;
                    $apr_user = User::firstWhere('email', $apresentador->email);
                    $pa = new ParticipanteAtividade();
                    $pa->atividade_id = $a->id;
                    if ($apr_user != null) {
                        $pa->user_id = $apr_user->id;
                        $apr->user()->associate($apr_user->id);
                    }
                    $apr->atividade()->associate($a->id);
                    $apr->save();
                    $pa->apresentador_id = $apr->id;
                    $pa->save();
                }


            }
            $path = "images/eventos/{$e->id}/";
            $banner = $request->file('banner');
            $nome_banner = $path . "banner/" . Str::uuid() . '-' . $banner->getClientOriginalName();
            Storage::cloud()->put($nome_banner, $banner->getContent());

            foreach ($request->file('imagem') as $key => $i) {
                $img = new Imagem();
                $nome = $path . "outras/" . Str::uuid() . '-' . $i->getClientOriginalName();
                Storage::cloud()->put($nome, $i->getContent());
                $img->imagem = Storage::cloud()->url($nome);
                $img->evento()->associate($e->id);
                $img->tipo()->associate(1);
                $img->save();
            }
            $e->banner = Storage::cloud()->url($nome_banner);
            $e->save();
        });

        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $evento = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome")->with('apresentadores');
        }])
            ->withCount(['atividades as apresentadores_count' => function (Builder $query) {
                $query->select(DB::raw('count(distinct(apresentadores.email))'))
                    ->join('apresentadores', 'apresentadores.atividade_id', '=', 'atividades.id');
            }])->with('imagens')
            ->find($id);
        return response()->json($evento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse {
        $user = Auth::user();
        $instituicao = Instituicao::whereRelation('administrador', 'id', $user->id)->first();
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'min:10', 'max:100'],
            'expectativa_participantes' => ['required', 'integer'],
            'link_evento' => ['max:100', 'nullable'],
            'breve_descricao' => ['required', 'string', 'max:100'],
            'local' => ['nullable', 'max:500'],
            'descricao' => ['nullable'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'atividades' => ['required'],
            'atividades.*.nome' => ['required', 'max:255'],
            'atividades.*.data' => ['required', 'date', 'after:today'],
            'atividades.*.horario_inicio' => ['required', 'date_format:H:i'],
            'atividades.*.horario_fim' => ['required', 'date_format:H:i', 'after:atividades.*.horario_inicio'],
            'atividades.*.local' => ['nullable', 'max:200'],
            'atividades.*.link_tranmissao' => ['nullable', 'max:400'],
            'atividades.*.descricao' => ['nullable'],
            'atividades.*.tipo_atividade_id' => ['required', 'exists:tipo_atividades,id'],
            'atividades.*.nome_apresentador' => ['required', 'string', 'min:3', 'max:255'],
            'atividades.*.email_apresentador' => ['required', 'email'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $e = Evento::find($id);
        $e->nome = $request->nome;
        $e->breve_descricao = $request->breve_descricao;
        $e->expectativa_participantes = $request->expectativa_participantes;
        $e->link_evento = $request->link_evento;
        $e->local = $request->local;
        $e->descricao = $request->descricao;
        $e->tipo_id = 1;
        $e->instituicao_id = $instituicao->id;
        $e->categoria()->associate($request->categoria_id);
        $e->user()->associate($user->id);
        $e->save();

        //deleta as atividades que não são pertencentes mais
        $atividades = Atividade::hydrate((array)json_decode($request->atividades));
        $atividades = $atividades->flatten();
        $diff = collect($e->atividades->pluck('id'))->diff($atividades->pluck('id'));
        $e->atividades()->whereIn('id', $diff)->delete();

        //Cria as novas ou atualiza as recentes
        foreach ($atividades as $atv) {
            $a = null;
            if ($e->atividades->contains($atv->id)) {
                $a = Atividade::find($atv->id);
            } else {
                $a = new Atividade();
            }
            $a->nome = $atv->nome;
            $a->data = $atv->data;
            $a->horario_inicio = $atv->horario_inicio;
            $a->horario_fim = $atv->horario_fim;
            $a->tipo_atividade()->associate($atv->tipo_atividade_id);
            $a->evento()->associate($e->id);
            $a->nome_apresentador = $atv->nome_apresentador;
            $a->email_apresentador = $atv->email_apresentador;

            $apr = User::firstWhere('email', $a->email_apresentador);
            if ($apr != null) {
                $a->apresentador()->associate($apr->id);
            }
            $a->save();
            if ($a->nome_apresentador != null) {
                $pa = new ParticipanteAtividade();
                $pa->atividade_id = $a->id;
                $pa->apresentador = true;
                if ($apr != null)
                    $pa->user_id = $apr->id;
                $pa->save();
            }
        }

        return response()->json(null, 201);
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

    public function compraIngresso(Request $request): JsonResponse {
        $user = Auth::user();
        $atividades_id = json_decode($request->atividades);
        $user->atividades()->sync($atividades_id);
        return response()->json($atividades_id, 201);
    }

    public function eventos_criados(): JsonResponse {
        $user = Auth::user();
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");

        }])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($eventos);
    }

    public function eventos_participados(): JsonResponse {
        $user = Auth::user();
        $eventos = Evento::whereHas('atividades', function (Builder $query) use ($user) {
            $query->whereRelation('users', 'users.id', $user->id);
        })
            ->with(['atividades' => function ($query) use ($user) {
                $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
//                $query->whereRelation('users', 'users.id', $user->id);
            }])
            ->get();
        return response()->json($eventos);
    }

    public function atividades_participadas($id): JsonResponse {
        $user = Auth::user();
        $atividades = Atividade::whereRelation('users', 'users.id', $user->id)
            ->whereRelation('evento', 'eventos.id', $id)
            ->get();
        return response()->json($atividades);
    }
}

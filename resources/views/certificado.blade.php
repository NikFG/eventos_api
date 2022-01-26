<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificado</title>

    <title>Laravel</title>


    <!-- Fonts -->


    <!-- Styles -->
    <style>
        /* page with a4 landscape size*/
        @page {
            size: A4 landscape;
            margin: 0;
            padding: 0;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-image: url({{\Illuminate\Support\Facades\Storage::url($modelo->imagem_fundo)}});

            background-position: center top;
            background-repeat: no-repeat;
            z-index: -1;
        }

        body {
            margin: 0;
            position: relative;
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont,
            Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            font-size: 18pt;
        }


        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .main {
            /*display: table-cell;*/
        }

        .imgTexto {
            background-color: rgba(255, 255, 255, 1.0);
            margin-top: 0.5cm;
            margin-left: 0.5cm;
            height: 600px;
            width: 900px;
            z-index: 0;
            position: absolute;
        }

        .logo {
            height: 100px;
            width: 100%;
            margin-left: 0;
            background-image: url({{\Illuminate\Support\Facades\Storage::url($modelo->logo)}});
            background-repeat: no-repeat;
            background-position: center left;
            background-size: 100% 100px;

        }

        .titulo {
            justify-content: center;
            text-align: center;
            font-weight: bold;
            font-size: 24pt;
            margin-left: 1.5rem;
        }


        .divTexto {
            color: black;
            width: 100%;
        }

        .texto {
            margin-left: 1rem;
            text-align: justify;
            font-size: 16pt;
        }

        .negrito {
            font-weight: bold;
        }

        .certificado {
            justify-content: center;
            align-content: center;
            text-align: center;
            font-weight: bolder;
            font-size: 30pt;
            margin-top: 1.2rem !important;
            width: 100%;
        }

        .cidade {
            text-align: right;
            font-size: 14pt;
            height: 50px;
            right: 1cm;
            display: block;
        }

        .assinatura {
            /*background-color: rgba(150, 150, 150, 0.5) !important;*/
            -webkit-print-color-adjust: exact;
            height: 1.5cm;
            text-align: center;
        }

        .nome_assinatura {
            text-align: center;
        }

        .cargo {
            font-size: 10pt;
            text-align: center;
        }

        .content {
            padding: 1.5cm 0.70cm 2.00cm 1.50cm;
            /*padding: 3.5cm 0.50cm 2.00cm 0.50cm;*/
            display: block;

        }

        .codigo {
            bottom: 0;
            left: 0;
            font-size: 10pt;
            text-align: center;
        }
    </style>

    <style>

    </style>
</head>
<body class="antialiased">

<div id="page-body">
    <div class="overlay">

    </div>
    <div class="content">
        <div class="row imgTexto">
            <div class="logo">
            </div>
            {{--            <div class="titulo">--}}
            {{--                titulo--}}
            {{--            </div>--}}
            <div class="certificado">
                CERTIFICADO
            </div>
            <div class="divTexto">
                <p class="texto">Certifico que <span
                        class="negrito">{{$nome}}</span> participou com êxito da atividade <span
                        class="negrito">{{$atividade->nome}}</span> realizada
                    em {{\Carbon\Carbon::parse($atividade->data)->format("d/m/Y")}} durante o
                    evento {{$atividade->evento->nome}} com
                    a carga horário total de {{$certificado->horas}} hora(s).</p>
            </div>
            <div class="cidade">
                {{$instituicao->cidade}}, {{$data}}

            </div>

            <div>
                <div>
                    <div class="assinatura">
                        _________________________________________
                    </div>
                    <div class="nome_assinatura">
                        {{$modelo->nome_assinatura}}
                    </div>
                    <div class="cargo">
                        {{$modelo->cargo_assinatura}}
                    </div>
                </div>

            </div>
            <p class="codigo">
                Para verificar o certificado, clique aqui: <a href="{{$verifica_url}}">{{$verifica_url}}</a><br/>
                Código de verificação: {{$certificado->codigo_verificacao}}
            </p>
        </div>
    </div>


</div>
</body>
</html>

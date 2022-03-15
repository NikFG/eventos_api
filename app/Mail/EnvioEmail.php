<?php

namespace App\Mail;

use App\Models\Atividade;
use App\Models\Certificado;
use App\Models\Instituicao;
use App\Models\ModeloCertificado;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class EnvioEmail extends Mailable {
    use Queueable, SerializesModels;

    private $nome;
    private $email;
    private $certificado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $nome, string $email, Certificado $certificado) {
        $this->nome = $nome;
        $this->email = $email;
        $this->certificado = $certificado;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        $this->subject('Novo certificado para você ' . $this->nome);
        $this->to($this->email, $this->nome);

        $modelo = ModeloCertificado::find($this->certificado->modelo_certificado_id);
        $atividade = Atividade::find($this->certificado->atividade_id);
        $instituicao = Instituicao::find($this->certificado->instituicao_id);

        Carbon::setLocale('pt_BR');
        //conversão e formatação da data
        $data = Carbon::parse($this->certificado->data_emissao)->translatedFormat('d')
            . " de " . Carbon::parse($this->certificado->data_emissao)->translatedFormat('F')
            . " de " . Carbon::parse($this->certificado->data_emissao)->translatedFormat('Y');

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('certificado', [
            'certificado' => $this->certificado,
            'modelo' => $modelo,
            'nome' => $this->nome,
            'atividade' => $atividade,
            'instituicao' => $instituicao,
            'data' => $data,
            'verifica_url' => env('HOME_APLICACAO') . '/certificado/verificar'
        ])->setPaper('a4', 'landscape')->setWarnings(false);

        $arquivo = $pdf->output();
        $this->attachData($arquivo, 'certificado.pdf');

        return $this->markdown('mail.emailCertificado', ['nome' => $this->nome]);
    }
}

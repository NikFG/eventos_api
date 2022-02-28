<?php

namespace App\Mail;

use App\Models\Atividade;
use App\Models\Certificado;
use App\Models\Instituicao;
use App\Models\ModeloCertificado;
use PDF;
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
        set_time_limit(0);
        setlocale(LC_ALL, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
        setlocale(LC_TIME, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');

        $this->subject('Novo certificado para você ' . $this->nome);
        $this->to($this->email, $this->nome);

        $modelo = ModeloCertificado::find($this->certificado->modelo_certificado_id);
        $atividade = Atividade::find($this->certificado->atividade_id);
        $instituicao = Instituicao::find($this->certificado->instituicao_id);

        $data = Carbon::parse($this->certificado->data_emissao)->formatLocalized('%d de %B de %Y');
        $pdf = PDF::loadView('certificado', [
            'certificado' => $this->certificado,
            'modelo' => $modelo,
            'nome' => $this->nome,
            'atividade' => $atividade,
            'instituicao' => $instituicao,
            'data' => $data,
            'verifica_url' => env('HOME_APLICACAO').'/certificado/verificar'
        ])->setPaper('a4', 'landscape')->setWarnings(false);

        $path = 'certificados/' . $this->certificado->id . '.pdf';

        $arquivo = $pdf->output();
        Storage::cloud()->put($path, $arquivo);
        $this->attachData($arquivo, 'certificado.pdf');

        return $this->markdown('mail.emailCertificado', ['nome' => $this->nome]);

    }
}

<?php

namespace App\Mail;

use App\Models\Atividade;
use App\Models\Certificado;
use App\Models\Instituicao;
use App\Models\ModeloCertificado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;


class EnvioEmail extends Mailable {
    use Queueable, SerializesModels;

    private $user;
    private $certificado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Certificado $certificado) {
        $this->user = $user;
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

        $this->subject('Novo certificado para você ' . $this->user->nome);
        $this->to($this->user->email, $this->user->nome);

        $modelo = ModeloCertificado::find($this->certificado->modelo_certificado_id);
        $atividade = Atividade::find($this->certificado->atividade_id);
        $instituicao = Instituicao::find($this->certificado->instituicao_id);

        $data = Carbon::parse($this->certificado->data_emissao)->formatLocalized('%d de %B de %Y');
        $pdf = PDF::loadView('certificado', [
            'certificado' => $this->certificado,
            'modelo' => $modelo,
            'participante' => $this->user,
            'atividade' => $atividade,
            'instituicao'=>$instituicao,

        ])->setPaper('a4', 'landscape')->setWarnings(false);


        $this->attachData($pdf->output(), 'certificado.pdf');
        return $this->markdown('mail.emailCertificado', ['user' => $this->user]);

    }
}

<?php

namespace App\Jobs;

use App\Mail\EnvioEmail;
use App\Models\Certificado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnvioEmailJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 500;
    public $maxExceptions = 2;
    private $nome;
    private $email;
    private $certificado;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $nome, string $email, Certificado $certificado) {
        $this->nome = $nome;
        $this->email = $email;
        $this->certificado = $certificado;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        Mail::send(new EnvioEmail($this->nome, $this->email, $this->certificado));
    }
}

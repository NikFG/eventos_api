<?php

namespace App\Jobs;

use App\Mail\EnvioEmail;
use App\Models\Certificado;
use App\Models\User;
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
    private $user;
    private $certificado;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Certificado $certificado) {
        $this->user = $user;
        $this->certificado = $certificado;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        Mail::send(new EnvioEmail($this->user, $this->certificado));
    }
}

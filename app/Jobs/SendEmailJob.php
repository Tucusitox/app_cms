<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $asunto;
    protected $codigo;
    protected $token;
    protected $nombre;
    protected $correoContact;
    protected $mensaje;
    protected $destinatario;

    public function __construct($asunto, $codigo = null, $token = null, $nombre = null, $correoContact = null, $mensaje, $destinatario)
    {
        $this->asunto = $asunto;
        $this->codigo = $codigo;
        $this->token = $token;
        $this->nombre = $nombre;
        $this->correoContact = $correoContact;
        $this->mensaje = $mensaje;
        $this->destinatario = $destinatario;
    }

    public function handle()
    {
        try {
            Mail::to($this->destinatario)->send(new SendEmail(
                $this->asunto,
                $this->codigo,
                $this->token,
                $this->nombre,
                $this->correoContact,
                $this->mensaje
            ));
        } catch (\Exception $e) {
            error_log('Error al enviar el correo: ' . $e->getMessage());
        }
    }
}

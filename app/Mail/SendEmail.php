<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $asunto;
    protected $codigo;
    protected $token;
    protected $nombre;
    protected $correoContact;
    protected $mensaje;

    /**
     * Create a new message instance.
     */
    public function __construct($asunto, $codigo = null, $token = null, $nombre = null, $correoContact = null, $mensaje)
    {
        $this->asunto = $asunto;
        $this->codigo = $codigo;
        $this->token = $token;
        $this->nombre = $nombre;
        $this->correoContact = $correoContact;
        $this->mensaje = $mensaje;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->asunto,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.contact-form',
            with: [
                'codigo' => $this->codigo,
                'token' => $this->token,
                'nombre' => $this->nombre,
                'correoContact' => $this->correoContact,
                'mensaje' => $this->mensaje,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

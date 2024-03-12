<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Compte extends Mailable
{

    /**
     * Create a new message instance.
     */
    use Queueable, SerializesModels;

    public $accountNumber;
    public $nationalId;

    public function __construct($accountNumber, $nationalId)
    {
        $this->accountNumber = $accountNumber;
        $this->nationalId = $nationalId;
    }

    public function build()
    {
        return $this->view('emails.mail');
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Compte',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content())->view('mails.mail')->with([
            'accountNumber' => $this->accountNumber,
            'nationalId' => $this->nationalId,
        ]);
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

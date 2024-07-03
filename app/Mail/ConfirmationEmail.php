<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $confirmationCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $confirmationCode)
    {
        $this->user = $user;
        $this->confirmationCode = $confirmationCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation')
            ->subject('Conferma la tua registrazione')
            ->with([
                'confirmationCode' => $this->confirmationCode,
                'user' => $this->user,
            ]);
    }
}

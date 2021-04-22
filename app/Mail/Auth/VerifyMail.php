<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function build()
    {
        return $this
            ->subject('Подтверждение почты!')
            ->markdown('emails.auth.verify');
    }
}

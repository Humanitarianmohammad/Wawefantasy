<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name, $uid, $email, $otp;
    public function __construct($name, $uid, $email, $otp)
    {
        $this->name = $name;
        $this->uid = $uid;
        $this->email = $email;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.verifyEmailOtp')
            ->subject('OTP to verify Email Id')
            ->with([
                'name' => $this->name,
                'uid' => $this->uid,
                'email' => $this->email,
                'otp' => $this->otp,
            ]);
        return $email;
    }
}

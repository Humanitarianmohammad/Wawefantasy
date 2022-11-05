<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name, $uid, $product_name;
    public function __construct($name, $uid, $product_name)
    {
        $this->name = $name;
        $this->uid = $uid;
        $this->product_name = $product_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.order_booking_confirmation')
            ->subject('Order confirmation')
            ->with([
                'name' => $this->name,
                'uid' => $this->uid,
                'product_name' => $this->product_name,
            ]);
        return $email;
    }
}

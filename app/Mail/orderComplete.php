<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderComplete extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user_name, $agent_name, $weight, $amount, $product_name;
    public function __construct($user_name, $agent_name, $weight, $amount, $product_name)
    {
        $this->user_name = $user_name;
        $this->agent_name = $agent_name;
        $this->weight = $weight;
        $this->amount = $amount;
        $this->product_name = $product_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.order_completion')
            ->subject('Order successfully completed')
            ->with([
                'user_name' => $this->user_name,
                'agent_name' => $this->agent_name,
                'weight' => $this->weight,
                'amount' => $this->amount,
                'product_name' => $this->product_name,
            ]);
        return $email;
    }
}

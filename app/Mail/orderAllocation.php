<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderAllocation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user_name, $agent_name, $user_address, $user_pincode, $user_mobile, $product_name;
    public function __construct($user_name, $agent_name, $user_address, $user_pincode, $user_mobile, $product_name)
    {
        $this->user_name = $user_name;
        $this->agent_name = $agent_name;
        $this->user_address = $user_address;
        $this->user_pincode = $user_pincode;
        $this->user_mobile = $user_mobile;
        $this->product_name = $product_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.order_allocation')
            ->subject('New order allocation')
            ->with([
                'user_name' => $this->user_name,
                'agent_name' => $this->agent_name,
                'user_address' => $this->user_address,
                'user_pincode' => $this->user_pincode,
                'user_mobile' => $this->user_mobile,
                'product_name' => $this->product_name,
            ]);
        return $email;
    }
}

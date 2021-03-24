<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMessage extends Mailable
{
    use Queueable, SerializesModels;

    private $firstName;
    private $lastname;
    private $email;
    private $telephone;
    private $ordernumber;
    private $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($firstName, $lastname, $email, $telephone, $ordernumber, $message)
    {
        $this->firstName = $firstName;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->ordernumber = $ordernumber;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address'=>$this->email, 'name'=>$this->firstName . " " . $this->lastname])
                    ->view('customer.layouts.email');
        #return $this->view('customer.layouts.email');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class MailAfterReservation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tableIds, $paymentDate)
    {
        $this->tableIds = $tableIds;
        $this->paymentDate = $paymentDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.afterReservation')
                    ->subject('Samanko Coffee Roasters')
                    ->with(['tableIds' => $this->tableIds , 'paymentDate' => $this->paymentDate]);
    }
}

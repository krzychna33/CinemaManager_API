<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationComplete extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $movie;
    public $seats;
    public $showingDate;
    public $deleteURL;


    public function __construct($movie, $seats, $showingDate, $deleteURL)
    {
        $this->movie = $movie;
        $this->seats = $seats;
        $this->showingDate = $showingDate;
        $this->deleteURL = $deleteURL;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('maxkill97hd@gmail.com')
            ->subject('Reservation comfirmation')
            ->view('reservationComplete');
    }
}

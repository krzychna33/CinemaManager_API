<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReservationService;
use App\Reservation;
use App\Showing;
use App\Movie;
use Illuminate\Support\Facades\DB;
use App\Mail\ReservationComplete;
use Illuminate\Support\Facades\Mail;


class ReservationsController extends Controller
{
    private $reservationService;

    public function __construct(ReservationService $reservationService){
        $this->reservationService = $reservationService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $showingId = $request->get('showingId');
        $email = $request->get('email');
        $seats = $request->get('seats');

        //return $this->reservationService->check($seats[0], $showingId);



        foreach ($seats as $seat) {
            if(!$this->reservationService->validateSeats($seat)){
                return response()->json([
                    'success' => false,
                    'message' => 'Wrong seats!'
                ], 400);
            }
            if(!$this->reservationService->check($seat, $showingId)){
                return response()->json([
                    'success' => false,
                    'message' => 'Seats already taken!'
                ], 400);
            }
        }
        
        $deleteHash = hash('sha256', "Reservation".$showingId.$seat['row'].$seat['seat']);

        foreach($seats as $seat){
            $reservation = new Reservation;
            $reservation->showingId = $showingId;
            $reservation->email = $email;
            $reservation->row = $seat['row'];
            $reservation->seat = $seat['seat'];
            $reservation->deleteHash = $deleteHash;
            $reservation->save();
        }

        $deleteURL = env('APP_URL')."/api/reservations/cancel-reservation/".$deleteHash;
        $showing = Showing::find($showingId);
        $movie = $showing->movie->title;
        $showingDate = $showing->showingTime;

        Mail::to($email)->send(new ReservationComplete($movie, $seats, $showingDate, $deleteURL));

        return response()->json([
            'success' => true,
            'message' => 'Reservation completed!',
            'data' => $seats
        ], 400);


    }


    public function cancelReservation($hash){
        Reservation::where('deleteHash', $hash)->delete();
        return "ANULOWANO REZERWACJE";
    }
}

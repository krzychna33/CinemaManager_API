<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReservationRepository;
use App\Reservation;
use App\Showing;
use App\Movie;
use Illuminate\Support\Facades\DB;
use App\Mail\ReservationComplete;
use Illuminate\Support\Facades\Mail;


class ReservationsController extends Controller
{
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository){
        $this->reservationRepository = $reservationRepository;
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

        foreach ($seats as $seat) {
            if(!$this->reservationRepository->validateSeats($seat)){
                return response()->json([
                    'success' => false,
                    'message' => 'Wrong seats!'
                ], 400);
            }
            if(!$this->reservationRepository->check($seat, $showingId)){
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

        $app_url = env('APP_URL');
        $deleteURL = $app_url."/api/reservations/cancel-reservation/".$deleteHash;
        $showing = Showing::find($showingId);
        $movie = $showing->movie->title;
        $showingDate = $showing->showingTime;

        Mail::to($email)->send(new ReservationComplete($movie, $seats, $showingDate, $deleteURL));

        return response()->json([
            'success' => true,
            'message' => 'Reservation completed!',
            'data' => $seats,
            'deleteURL' => $deleteURL
        ], 201);

    }

    public function cancelReservation($hash){
        Reservation::where('deleteHash', $hash)->delete();
        return 'Reservation canceled!';
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Reservation canceled!'
        // ], 204);
    }
}

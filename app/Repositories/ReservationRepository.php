<?php

namespace App\Repositories;

use App\Reservation;

class ReservationRepository{
    
    public function check($seat, $showingId){

        if(Reservation::where([
            ['seat', '=', $seat['seat']],
            ['row', '=', $seat['row']],
            ['showingId', '=', $showingId]
        ])->count()!=0){
            return false;
        }
        return true;
    }

    public function validateSeats($seat){
        $MAXROWS = 16;
        $MAXSEATS = 14;
        $MINROWS = 0;
        $MINSEATS = 0;

        if($seat['row'] > $MAXROWS || $seat['row'] < $MINROWS || $seat['seat'] > $MAXSEATS || $seat['seat'] < $MINSEATS ){
            return false;
        }
        return true;
    }

}


<?php

namespace App\Repositories;

use App\Showing;
use Carbon\Carbon;

class ShowingService{
    
    public function findShowingsByDate($time, $endTime){
        return Showing::where([
            ['showingTime', '<=', $endTime],
            ['showingEndTime', '>=', $time]
        ])->get();
    }
}
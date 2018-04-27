<?php

namespace App\Repositories;

use App\Showing;
use Carbon\Carbon;

class ShowingRepository{
    
    public function findShowingsByDate($time, $endTime){
        return Showing::where([
            ['showingTime', '<=', $endTime],
            ['showingEndTime', '>=', $time]
        ])->get();
    }
}
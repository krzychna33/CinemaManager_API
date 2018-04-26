<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Reservation;
use App\Movie;

class Showing extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['movie_id', 'showingTime', 'showingEndTime', 'active', 'price'];


    public function reservations(){
        return $this->hasMany(Reservation::class, 'showingId');
    }

    public function Movie(){
        return $this->belongsTo(Movie::class);
    }
}

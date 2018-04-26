<?php

use Illuminate\Database\Seeder;
use App\Movie;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movie = new Movie;
        $movie->title = "Szklana Pułapka";
        $movie->year = "2005";
        $movie->description = "testowa";
        $movie->save();

        $movie = new Movie;
        $movie->title = "Before I Fall";
        $movie->year = "2017";
        $movie->description = "testowa";
        $movie->save();
    }
}

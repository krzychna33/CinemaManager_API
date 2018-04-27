<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $movie = Movie::create($request->all());
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Movie created!',
            'data' => $movie
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        
        if($movie){
            return response()->json([
                'success' => true,
                'message' => 'Movie has found!',
                'data' => $movie
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Movie not found!',
            ], 404);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        if($movie->update($request->all())){
            return response()->json([
                'success' => true,
                'message' => 'Movie has found!',
                'data' => $movie
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Update error!',
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::destroy($id);
        if($movie){
            return response()->json([
                'success' => true,
                'message' => 'Movie has deleted!',
                'data' => $movie
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Movie has not deleted!',
            ], 400);
        }
    }
}

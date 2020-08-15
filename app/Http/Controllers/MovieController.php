<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index() {
        $movies = Movie::orderBy('id')->paginate(10);

        return response()->json([
            'movies' => $movies,
        ], 200);
    }

    public function show(Movie $movie) {
        try {
            return response()->json([
                'movie' => $movie,
            ], 200);
        } catch(\Exception $e) {
            return response()->json([
                'error' => $e,
            ], 404);
        }
    }

    public function store(MovieRequest $request) {
        $new_movie = new Movie();
        $new_movie->name = $request->input('name');
        $new_movie->release_date = $request->input('release_date');
        $new_movie->image_path = 'Test Movie 1';
        $new_movie->save();

        return response()->json([
            'msg' => 'Movie saved sucessfully',
            'new_movie' => $new_movie,
        ], 200);
    }

    public function update(Request $request, Movie $movie) {
        dd($movie);
    }

    public function delete(Movie $movie) {
        $movie->delete();

        return response()->json([
            'msg' => 'Movie deleted sucessfully',
        ], 200);
    }
}

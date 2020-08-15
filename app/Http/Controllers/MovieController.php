<?php

namespace App\Http\Controllers;

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
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index() {
        $movies = Movie::orderBy('id')->paginate(10);

        return response()->json([
            'movies' => $movies,
        ], 200);
    }

    public function show($id) {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'msg' => 'Id provided does not exist.',
            ], 422);
        }

        return response()->json([
            'movie' => $movie->load(['schedules' => function ($query) {
                $query->where('is_active', true);
            }]),
        ], 200);
    }

    public function store(MovieRequest $request) {
        $image = $request->file('image');
        $image_name = time() . $image->getClientOriginalName();
        $image_path = 'movies/' . $image_name;
        Storage::disk('local')->put('public/' . $image_path, file_get_contents($image), 'public');

        $new_movie = new Movie();
        $new_movie->name = $request->input('name');
        $new_movie->release_date = $request->input('release_date');
        $new_movie->is_active = $request->input('is_active');
        $new_movie->image_path = asset('storage/' . $image_path);
        $new_movie->save();

        return response()->json([
            'msg' => 'Movie saved successfully',
            'new_movie' => $new_movie,
        ], 200);
    }

    public function update(Request $request, $id) {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'msg' => 'Id provided does not exist.',
            ], 422);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . $image->getClientOriginalName();
            $image_path = 'movies/' . $image_name;
            Storage::disk('local')->put('public/' . $image_path, file_get_contents($image), 'public');
            $movie->image_path = asset('storage/' . $image_path);
        }

        $movie->name = $request->input('name');
        $movie->release_date = $request->input('release_date');
        $movie->is_active = $request->input('is_active');
        $movie->save();

        return response()->json([
            'msg' => 'Movie updated successfully',
            'schedule' => $movie,
        ], 200);
    }

    public function delete($id) {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'msg' => 'Id provided does not exist.',
            ], 422);
        }

        $movie->delete();

        return response()->json([
            'msg' => 'Movie deleted successfully',
        ], 200);
    }

    public function assignSchedules(Request $request, Movie $movie) {
        $movie->schedules()->sync($request->input('schedules'));

        return response()->json([
            'msg' => 'Movie schedules have been updated successfully',
        ], 200);
    }
}

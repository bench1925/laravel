<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('play');
    }

    public function getAllSongs()
    {
        $songs = Song::all();
        return view('home', compact('songs'));
    }

    public function play($id)
    {
        $songs = Song::findOrFail($id);
        return response()->json(['song_filename' => asset('music/' . $songs->song_filename)]);
    }

    public function randomSong()
    {
        $randomSong = Song::inRandomOrder()->first();
        return response()->json(['random_song_id' => $randomSong->id]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function encours()
    {
        $events = Event::where('starts_at', '<', now())
        ->with(['user', 'tags'])
        ->orderBy('starts_at', 'asc')
        ->get();

        dd($events);
        return view('events.encours', compact('events'));

    }
}

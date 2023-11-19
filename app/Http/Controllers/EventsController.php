<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function event(){

        $events = Event::get();
        return view('events.event', compact('events'));
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        $request->validate([
            'event_name' => 'string|required',

        ]);

        $event = Event::create([
            'event_name' => $request->event_name,
        ]);

        return redirect('/events/')->with('Info','A new event has been created.');
    }
}

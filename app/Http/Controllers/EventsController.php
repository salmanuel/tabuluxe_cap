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
            'user_id' => auth()->user()->id
        ]);

        return redirect('/events/')->with('Info','A new event has been created.');
    }

    public function edit($id)
    {
        $events = Event::findOrFail($id);
        return view('events.edit-event', compact('events'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',

        ]);

        $event = Event::findOrFail($id);
        $event->event_name = $validatedData['event_name'];
        $event->save();

        return redirect()->route('events.event')->with('success', 'Activity updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.event')->with('success', 'Task deleted successfully.');
    }

}

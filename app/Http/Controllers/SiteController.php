<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Event;
use App\Models\Judge;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function loginForm() {
        if(!auth()->guest()) {
            return redirect('/home');
        }
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'email|required',
            'password' => 'string|required'
        ]);

        $login = auth()->attempt($request->only('email','password'));

        return redirect('/home');
    }

    public function home() {
        $totalEvents = Event::count();
        $totalJudges = Judge::count();
        $totalContests = Contest::where('dancesports', false)->count();
        $totalDancesports = Contest::where('dancesports', true)->count();

        return view('home', compact('totalEvents', 'totalJudges', 'totalContests', 'totalDancesports'));
    }

    public function logout() {
        auth()->logout();
        return redirect('/')->with('Info','You have been logged out.');
    }
}

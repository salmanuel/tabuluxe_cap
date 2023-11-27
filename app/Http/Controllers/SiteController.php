<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Event;
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
        $totalContests = Contest::count();

        return view('home', compact('totalEvents', 'totalContests'));
    }

    public function logout() {
        auth()->logout();
        return redirect('/')->with('Info','You have been logged out.');
    }
}

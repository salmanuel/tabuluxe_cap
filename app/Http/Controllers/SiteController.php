<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Event;
use App\Models\Judge;
use App\Models\User;
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

        // $auth = auth()->user();
        // $sidebarName = User::where('name', $auth->name)->first();

        return view('home', compact('totalEvents', 'totalJudges', 'totalContests', 'totalDancesports'));
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'string|required',
            'email' => 'email|required',
            'photo' => 'image|required' // Add validation for image uploads
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        
        // Handle file upload and storage
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Move the uploaded file to a specific directory
            $user->photo = 'images/' . $imageName; // Save the path to the image in the database
        }
    
        $user->save();
    
        return back();
    }
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $auth = auth()->user();
            $sidebarName = $auth ? User::where('name', $auth->name)->first() : null;

            view()->share('sidebarName', $sidebarName);

            return $next($request);
        });
    }


    public function logout() {
        auth()->logout();
        return redirect('/')->with('Info','You have been logged out.');
    }
}

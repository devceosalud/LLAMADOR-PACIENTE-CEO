<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function index()
    {
        return view('auth.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remenber)) {
            return back()->with('mensaje', 'Las credenciales estan incorrectas');
        }

        if (auth()->user()->name === 'admision') {
            return redirect()->route('admision.temporal.index');
        } elseif (auth()->user()->name === 'recepcion') {
            return redirect()->route('admision.temporal.index');
        } else {
            return redirect()->route('doctor.temporal.index');
        }
    }
}

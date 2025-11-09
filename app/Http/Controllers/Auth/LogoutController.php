<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //loogut user
        Auth::logout();

        // invalid session
        $request->session()->invalidate();

        // session regenerate
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $field = $request->only('username','password');

        if (Auth::attempt($field))
        {
            return redirect()->intended('master');
        }

        return redirect()->back()->with('errlogin', __("Username dan Password tidak ditemukan!"));
    }
}

<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Disaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $field = $request->only('username','password');

        $disaster = Disaster::where('default',1)->first();
        $request->session()->put('disaster',$disaster);

        if (Auth::attempt($field))
        {
            return redirect()->route('landing');
        }


        return redirect()->back()->with('errlogin', __("Username dan Password tidak ditemukan!"));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('landing');
    }
}

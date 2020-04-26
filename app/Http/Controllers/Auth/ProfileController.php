<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('auth.profile.index',compact('user'));
    }

    public function update(Request $request)
    {
        $rules = [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|confirmed',
        ];

        $request->validate($rules);

        $user = User::findOrFail(Auth::user()->id);
        $fields = $request->only(array_keys($rules));
        if ($request->filled('password') == false)
        {
            unset($fields['password']);
        }else{
            $fields['password'] = Hash::make($fields['password']);
        }
        $user->fill($fields);
        $user->save();

        return redirect()->back()->with('info',__('Profile Updated'));
    }
}

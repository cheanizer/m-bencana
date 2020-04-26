<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $rules;

    public function __construct()
    {
        $this->rules = [
            'username' => 'required|alpha_dash',
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required|numeric'
        ];
    }

    public function index()
    {
        $users = User::with('role')
        ->paginate(20);
        return view('user.index',compact('users'));
    }

    public function create(Request $request)
    {
        $roles = Role::all();
        $user = new User();
        return view('user.create',compact('user','roles'));
    }

    public function doCreate(Request $request)
    {
        $rules = array_merge($this->rules, ['password' => 'required|confirmed']);

        $request->validate($rules);

        $field = $request->only(array_keys($rules));
        $field['password'] = Hash::make($field['password']);
        $user = new User();
        $user->fill($field);
        $user->save();

        return redirect()->route('user')->with('success',__('Sukses Buat Pengguna'));
    }

    public function edit($id, Request $reuqest)
    {
        $user = User::findOrFail($id);

        return view('user.create',compact('user'));
    }

    public function doEdit($id, Request $request)
    {
        $user = User::findOrFail($id);

        $rules = array_merge($this->rules, ['password' => 'nullable|confirmed']);

        $request->validate($rules);

        $fields = $request->only(array_keys($rules));
        if ($request->filled('password'))
        {
            $fields['password'] = Hash::make($fields['password']);
        }else unset($fields['password']);
        $user->fill($fields);
        $user->save();

        return redirect()->back()->with('success',__('Sukses Update Pengguna'));
    }
}

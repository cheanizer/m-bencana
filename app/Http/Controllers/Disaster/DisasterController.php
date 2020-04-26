<?php
namespace App\Http\Controllers\Disaster;

use App\Http\Controllers\Controller;
use App\Models\Disaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisasterController extends Controller
{
    public function index()
    {
        $disasters = Disaster::with('by')->paginate(20);
        return view('disaster.index',compact('disasters'));
    }

    public function create()
    {
        $disaster = new Disaster();
        return view('disaster.form',compact('disaster'));
    }

    public function edit($id)
    {
        $disaster = Disaster::findOrFail($id);
        return view('disaster.form',compact('disaster'));
    }

    public function doCreate(Request $request)
    {
        $rules = [
            'bencana' => 'required',
            'deskripsi' => 'required',
            'mulai' => 'date',
            'status' => 'required'
        ];

        $request->validate($rules);
        $fields = $request->only(array_keys($rules));

        $disaster = new Disaster();
        $disaster->fill($fields);
        $disaster->createdby = Auth::user()->id;
        $disaster->save();

        return redirect()->route('disaster')->with('success',__('Data Bencana Telah Diinput'));
    }

    public function doEdit($id,Request $request)
    {
        $disaster = Disaster::findOrFail($id);

        $rules = [
            'bencana' => 'required',
            'deskripsi' => 'required',
            'mulai' => 'date',
            'status' => 'required'
        ];

        $request->validate($rules);
        $fields = $request->only(array_keys($rules));

        $disaster->fill($fields);
        $disaster->save();

        return redirect()->back()->with('success',__('Sukses edit data bencana'));
    }
}

<?php
namespace App\Http\Controllers\Observasi;

use App\Http\Controllers\Disaster\DisasterBase;
use App\Models\Observation;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp\Equal;

class ObservasiController extends DisasterBase
{
    protected $rules = [
        'nama' => 'required',
        'deskripsi' => 'required',
        'kategori' => 'required',
        'slug' => 'required',
    ];

    public function index(Request $request)
    {

        $observations = Observation::orderBy('created_at','desc')
        ->where('bencana_id',$request->get('disaster_id'))
        ->paginate(config('site.pagination'));

        return $this->response('observasi.index',compact('observations'));
    }

    public function create()
    {
        $observasi = new Observation();

        return $this->response('observasi.form',compact('observasi'));

    }

    public function doCreate(Request $request)
    {
        $request->validate($this->rules);

        $observasi = new Observation();
        $observasi->fill($request->only(array_keys($this->rules)));
        $observasi->bencana_id = app('request')->get('disaster_id');
        $observasi->save();

        return redirect()->route('observasi',['disaster_id' => $request->get('disaster_id')])->with('popup-info','Sukses Buat Observasi');
    }

    public function edit($observasi_id)
    {
        $observasi = Observation::findOrFail($observasi_id);
        return $this->response('observasi.form',compact('observasi'));
    }

    public function doEdit($id,Request $request)
    {
        $observasi = Observation::findOrFail($id);
        $request->validate($this->rules);

        $observasi->fill($request->only(array_keys($this->rules)));
        $observasi->save();

        return redirect()->back()->with('success','Sukses Edit observasi');
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => 'required']);

        $observasi = Observation::findOrFail($request->input('id'));
        $observasi->delete();

        return redirect()->back()->with('popup-info','Berhasil hapus observasi');
    }
}

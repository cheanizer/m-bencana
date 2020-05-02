<?php
namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Disaster\DisasterBase;
use App\Models\Disaster;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends DisasterBase
{
    protected $rules = [
        'namalokasi' => 'required',
        'deskripsi' => 'nullable',
        'jenislokasi' => 'required|integer',
        'propcd' => 'required|integer',
        'kabcd' => 'required|integer',
        'keccd' => 'required|integer',
        'desacd' => 'required|integer',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'kontakid' => 'nullable|integer'
    ];
    public function index($disaster_id, Request $request)
    {
        $this->disaster_id = $disaster_id;
        $locations = Location::filter($request->all())
        ->paginate(20);
        return $this->response('location.index',compact('locations'));
    }

    public function create($disaster_id)
    {
        $this->disaster_id = $disaster_id;
        $location = new Location();
        return $this->response('location.form',compact('location'));
    }

    public function doCreate($disaster_id, Request $request)
    {
        $this->disaster_id = $disaster_id;
        $request->validate($this->rules);
        $location = new Location();
        $location->fill($request->only(array_keys($this->rules)));
        $location->bencanaid = $this->disaster_id;
        $location->save();
        return redirect()->route('location',['id' => $this->disaster_id])
        ->with('popup-info','Sukses Input Lokasi');
    }

    public function edit($disaster_id,$id)
    {
        $this->disaster_id = $disaster_id;
        $location = Location::findOrFail($id);
        return $this->response('location.form',compact('location'));
    }

    public function doEdit($disaster_id,$id, Request $request)
    {
        $request->validate($this->rules);
        $location = Location::findOrFail($id);
        $location->fill($request->only(array_keys($this->rules)));
        $location->bencanaid = $disaster_id;
        $location->save();

        return redirect()->back()->with('success',"Sukses Edit Lokasi");
    }

    public function doDelete($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->back()->with('popup-info','Sukses Hapus Lokasi');
    }
}

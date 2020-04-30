<?php
namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationType;
use Illuminate\Http\Request;

class LocationTypeController extends Controller
{
    public function index()
    {
        $datas = LocationType::get();
        return view('common.locationtype_list',compact('datas'));
    }

    public function create()
    {
        $location_type = new LocationType();
        return view('common.locationtype_form',compact('location_type'));
    }

    public function doCreate(Request $request)
    {
        $request->validate(
            [
                'jenis_lokasi' => 'required'
            ]
        );

        $location_type = LocationType::create($request->only('jenis_lokasi'));

        $location_type->save();

        return redirect()->route('location.type')->with('popup-info','Jenis lokasi baru telah disimpan');
    }

    public function edit($id)
    {
        $location_type = LocationType::findOrFail($id);

        return view('common.locationtype_form',compact('location_type'));
    }

    public function doEdit($id,Request $request)
    {
        $request->validate([
            'jenis_lokasi' => 'required'
        ]);

        $location_type = LocationType::findOrFail($id);

        $location_type->fill($request->only('location_type'));
        $location_type->save();


        return redirect()->route('location.type')->with('popup-info','Sukses edit jenis lokasi');
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => 'required']);
        $location_type = LocationType::findOrFail($request->input('id'));

        $location_type->delete();

        return redirect()->route('location.type')->with('popup-info','Sukses hapus jenis lokasi');
    }
}

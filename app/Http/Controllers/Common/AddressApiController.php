<?php
namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\State;
use App\Models\SubDistrict;
use Illuminate\Http\Request;

Class AddressApiController extends Controller
{
    public function getState(Request $request)
    {
        $states = State::filter($request->all())->get();
        return response()->json($states);
    }

    public function getDistrict(Request $request)
    {
        $districs = District::filter($request->all())->get();

        return response()->json($districs);
    }

    public function getSubDistrict(Request $request)
    {
        $subDistricts = SubDistrict::filter($request->all())->get();

        return response()->json($subDistricts);
    }
}

<?php
namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Disaster;
use App\Models\Location;

Class LandingController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        $disaster = \App\Models\Disaster::where('default',1)->first();
        if (! $disaster) $disaster = Disaster::orderBy('bencanaid','desc')->first();
        return view('landing.index',compact('locations','disaster'));
    }
}

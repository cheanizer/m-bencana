<?php
namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Disaster\DisasterBase;
use App\Models\Disaster;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends DisasterBase
{
    public function index($disaster_id, Request $request)
    {
        $this->disaster_id = $disaster_id;
        return $this->response('location.index');
    }

    public function create($disaster_id)
    {
        $this->disaster_id = $disaster_id;
        $location = new Location();
        return $this->response('location.form',compact('location'));
    }
}

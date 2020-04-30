<?php
namespace App\Http\Controllers\Disaster;

use App\Http\Controllers\Controller;
use App\Models\Disaster;

class DisasterBase extends Controller{
    protected $disaster_id;
    protected function response($view,$data = [])
    {
        $disaster = Disaster::findOrFail($this->disaster_id);

        return view($view, array_merge(compact('disaster'), $data));
    }
}

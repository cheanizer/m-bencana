<?php
namespace App\Http\Controllers\Disaster;

use App\Http\Controllers\Controller;
use App\Models\Disaster;
use Illuminate\Http\Request;

class DisasterBase extends Controller{
    protected $disaster_id;
    protected function response($view,$data = [])
    {
        $disaster_id = app('request')->get('disaster_id');
        if ($disaster_id) $this->disaster_id = $disaster_id;
        $disaster = Disaster::findOrFail($this->disaster_id);
        return view($view, array_merge(compact('disaster'), $data));
    }
}

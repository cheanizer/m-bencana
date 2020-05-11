<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObservasiLokasi extends Model
{
    //
    use SoftDeletes;
    protected $table = 'observasi_lokasi';
    protected $guarded = ['id'];


    public function location()
    {
        return $this->belongsTo(Location::class, 'lokasiid','lokasiid');
    }

    public function observasi()
    {
        return $this->belongsTo(Observation::class, 'observasi_id','id');
    }
}

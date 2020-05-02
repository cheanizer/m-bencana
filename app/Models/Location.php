<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    //
    protected $table = 'lokasi';
    protected $primaryKey = 'lokasiid';
    protected $guarded = ['lokasiid'];
    public $timestamps = false;


    public function scopeFilter($query, $filter = [])
    {
        return $query;
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'propcd');
    }

    public function state() {
        return $this->belongsTo(State::class, 'kabcd');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'keccd');
    }

    public function subdistrict()
    {
        return $this->belongsTo(SubDistrict::class, 'desacd');
    }

}

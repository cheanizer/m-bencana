<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Observation extends Model
{
    //
    use SoftDeletes;
    protected $table = 'observasi';
    protected $guarded = ['id'];
    public function scopeFilter($query, $filter)
    {
        return $query;
    }

    public function observasiLokasi()
    {
        return $this->hasOne(ObservasiLokasi::class, 'observasi_id');
    }

    public function category()
    {
        return $this->belongsTo(ObserveCategory::class, 'kategori');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'lokasi';
    protected $primaryKey = 'lokasiid';
    protected $guarded = ['lokasiid'];
    public $timestamps = false;
}

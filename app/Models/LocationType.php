<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationType extends Model
{
    use SoftDeletes;
    //
    protected $table = 'jenis_lokasi';
    public $timestamps = false;
    protected $guarded = ['id'];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObserveCategory extends Model
{
    //
    protected $table = 'observasi_kategori';
    protected $guarded = ['id'];
    public $timestamps = false;
}

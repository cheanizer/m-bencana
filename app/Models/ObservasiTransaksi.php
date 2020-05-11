<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObservasiTransaksi extends Model
{
    //
    use SoftDeletes;

    protected $table = 'observasi_transaksi';
    protected $guarded = ['id'];
}

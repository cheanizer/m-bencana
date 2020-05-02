<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $table = 'tbl_kabkot';

    public $timestamps = false;

    public function scopeFilter($query, $filter = [])
    {
        extract($filter);
        if (! empty ($provinsi_id))
        {
            $query->where('provinsi_id',$provinsi_id);
        }
        return $query;
    }
}

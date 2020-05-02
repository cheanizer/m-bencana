<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    //
    protected $table = 'tbl_kelurahan';

    public $timestamps = false;

    public function scopeFilter($query, $filter = [])
    {
        extract($filter);

        if (! empty ($kecamatan_id))
        {
            $query->where('kecamatan_id',$kecamatan_id);
        }

        return $query;
    }
}

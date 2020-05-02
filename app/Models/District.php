<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $table = 'tbl_kecamatan';

    public $timestamps = false;

    public function scopeFilter($query, $filter = [])
    {
        extract($filter);

        if (! empty ($kabkot_id))
        {
            $query->where('kabkot_id',$kabkot_id);
        }

        return $query;
    }
}

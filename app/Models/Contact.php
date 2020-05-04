<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    //
    protected $table = 'kontak';
    protected $guarded = ['kontakid'];
    public $timestamps = false;
    protected $primaryKey = 'kontakid';

    public function scopeFilter($query, $filter = [])
    {
        extract($filter);

        if (! empty ($search))
        {
            $query->where('name','like','%'.$search.'%');
        }

        return $query;

    }
}

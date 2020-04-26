<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Disaster extends Model
{
    //
    protected $table = 'bencana';
    protected $primaryKey = 'bencanaid';

    protected $dates= ['mulai','selesai'];
    protected $guarded = ['bencanaid'];
    public $timestamps = false;


    public function by()
    {
        return $this->belongsTo(User::class, 'createdby');
    }

    public function setMulaiAttribute($value)
    {
        $this->attributes['mulai'] = Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }
}

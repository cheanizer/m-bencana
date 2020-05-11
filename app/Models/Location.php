<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    //
    protected $table = 'lokasi';
    protected $primaryKey = 'lokasiid';
    protected $guarded = ['lokasiid'];
    public $timestamps = false;


    public function scopeFilter($query, $filter = [])
    {
        extract($filter);

        if (! empty ($bencanaid))
        {
            $query->where('bencanaid',$bencanaid);
        }


        if (! empty ($search))
        {
            $query->where(function($query) use ($search){
                return $query->where('namalokasi','like','%'.$search.'%');
            });
        }

        return $query;
    }


    public function scopeDisaster($query,$disaster_id)
    {
        return $query->where('bencanaid',$disaster_id);
    }

    public function bencana()
    {
        return $this->belongsTo(Disaster::class,'bencanaid');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'propcd');
    }

    public function state() {
        return $this->belongsTo(State::class, 'kabcd');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'keccd');
    }

    public function subdistrict()
    {
        return $this->belongsTo(SubDistrict::class, 'desacd');
    }

    public function type()
    {
        return $this->belongsTo(LocationType::class, 'jenislokasi');
    }

    public function observasi()
    {
        return $this->belongsToMany(Observation::class, 'observasi_lokasi','observasi_id','lokasiid');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'kontakid');
    }

}

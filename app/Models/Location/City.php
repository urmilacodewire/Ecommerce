<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'cities';
    protected $fillable = ['name', 'state_id','districtid'];

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'districtid');
    }
}

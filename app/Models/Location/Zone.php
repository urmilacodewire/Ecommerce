<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'zones';
    protected $fillable = ['name', 'state_id','district_id','type','status'];

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
}

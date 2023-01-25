<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'districts';
    protected $fillable = ['name', 'state_id', 'zone_id', 'status','code'];

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }
}

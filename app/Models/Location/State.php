<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'states';
    protected $fillable = ['name', 'status','name','code'];

    public function cities()
    {
        return $this->hasMany(City::class,'StateId');
    }
}

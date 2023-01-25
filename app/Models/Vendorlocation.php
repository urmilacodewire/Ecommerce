<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendorlocation extends Model
{
    use HasFactory;

    protected $table = 'vendor_location';
    protected $fillable = [
        'vendor_id', 'location_name', 'location_address', 'lat', 'longs'
    ];

    public $timestamps = false;
}

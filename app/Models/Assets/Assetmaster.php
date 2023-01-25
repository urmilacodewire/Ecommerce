<?php

namespace App\Models\Assets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assetmaster extends Model
{
    use HasFactory;

    protected $table = 'assetmasters';
    protected $primarykey = 'id';
    protected $fillable = ['name'];
}

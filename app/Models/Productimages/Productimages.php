<?php

namespace App\Models\Productimages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productimages extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $fillable = ['product_id','imagename'];
}

<?php

namespace App\Models\Wishlist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_slug','product_id','product_qunty','prod_name','prod_image'];
}

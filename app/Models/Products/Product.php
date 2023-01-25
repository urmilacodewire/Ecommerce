<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['vendor_id','name','category_id','type','brand','model','color','size','warranty','mrp','price','quantity','description','image','slug','order','meta_title','meta_desc','meta_keyword','popular'];
}

<?php

namespace App\Models\RatingReviews;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating_review extends Model
{
    use HasFactory;

    protected $table = 'rating_review';

    protected $fillable = ['user_id','product_id','rating','review'];


}

<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','user_slug','product_ids','product_qunty','per_prod_price','total_amt','amt_after_coupon','delivery_addr','city','state','pincode','couponcode','couponvalue','coupontype','payment_id','payment_type','payment_status','order_status','o_date','o_time','status'];
}

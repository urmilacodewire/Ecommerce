<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
         'vendor_id', 'joining_date', 'aadhar_number', 'name', 'email', 'phone', 'alternate_phone', 'landline_no', 'address', 'state', 'city', 'pincode', 'company_name', 'company_type', 'authorized_person_name', 'authorized_person_phone', 'account_number', 'ifsc_code', 'bank_name', 'passbook_photo', 'account_holder_name', 'type', 'image', 'remember_token', 'password', 'lat', 'lon', 'aboutus', 'company_size', 'industry', 'website', 'status','headquarters','specialties','payment_type','payment_value'
     ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'vendors';
    protected $guard = 'vendor';
}

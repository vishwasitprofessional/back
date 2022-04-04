<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $primarykey="id";
    protected $table = 'coupons';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
}

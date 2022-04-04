<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primarykey="id";
    protected $table = 'orders';
    protected $guarded=[]; 
    public $timestamps=true; 
    use HasFactory;
    
    public function relUser(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    
    public function relOrderItem(){
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');
    }
    
    public function relShippingAddress(){
        return $this->belongsTo(ShippingAddress::class,'address_id', 'id');
    }
}

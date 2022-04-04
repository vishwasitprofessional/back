<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $primarykey="id";
    protected $table = 'shipping_addresses';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
    
    public function relUser(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    
    
    public function relOrder(){
        return $this->hasMany('App\Models\Order', 'address_id', 'id');
    }
    
    public function relState(){
        return $this->belongsTo(State::class,'state', 'id');
    }
    
    public function relCountry(){
        return $this->belongsTo(Country::class,'country', 'id');
    }
    
    public function relBState(){
        return $this->belongsTo(State::class,'b_state', 'id');
    }
    
    public function relBCountry(){
        return $this->belongsTo(Country::class,'b_country', 'id');
    }
}

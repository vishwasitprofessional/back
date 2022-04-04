<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    
    public function relShippingAddress(){
        return $this->hasOne('App\Models\ShippingAddress', 'state', 'id');
    }
    
    
    public function relBillingAddress(){
        return $this->hasOne('App\Models\ShippingAddress', 'b_state', 'id');
    }
}

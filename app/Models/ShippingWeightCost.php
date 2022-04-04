<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingWeightCost extends Model
{
    protected $primarykey="id";
    protected $table = 'shipping_weight_costs';
    protected $guarded=[]; 
    public $timestamps=true; 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $primarykey="id";
    protected $table = 'order_items';
    protected $guarded=[]; 
    public $timestamps=true; 
    use HasFactory;
    
    public function relOrder(){
        return $this->belongsTo(Order::class,'order_id', 'id');
    }
    
    public function relProductVarient(){
        return $this->belongsTo(ProductVarient::class,'varient_id', 'id');
    }
    
    public function relReview(){
        return $this->hasOne('App\Models\Review', 'order_item_id', 'id');
    }

    public function relVendor(){
        return $this->belongsTo(User::class,'vendor_id', 'id');
    }

}

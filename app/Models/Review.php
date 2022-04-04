<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primarykey="id";
    protected $table = 'reviews';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
    
    public function relOrderItem(){
        return $this->belongsTo(OrderItem::class,'order_item_id', 'id');
    }
}

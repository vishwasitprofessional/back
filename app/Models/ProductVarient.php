<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVarient extends Model
{
    protected $primarykey="id";
    protected $table = 'product_varients';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;

    public function relProduct(){
        return $this->belongsTo(Product::class,'pro_id', 'id');
    }
    public function relCategory(){
        return $this->belongsTo(Category::class,'cat_id', 'id')->where('status','active');
    }
    
    public function relChildCategory(){
        return $this->belongsTo(Category::class,'child_cat_id', 'id')->where('status','active');
    }
    
    public function relProductVarient(){
        return $this->hasMany('App\Models\ProductVarient', 'varient_id', 'id');
    }
    
    public function relOrderItem(){
        return $this->hasMany('App\Models\OrderItem', 'varient_id', 'id');
    }
}

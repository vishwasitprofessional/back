<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $primarykey="id";
    protected $table = 'products';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;

    
    public function relCategory(){
        return $this->belongsTo(Category::class,'cat_id', 'id')->where('status','active');
    }
    public function relBrand(){
        return $this->belongsTo(Brand::class,'brand_id', 'id')->where('status','show');
    }
    public function relVendor(){
        return $this->belongsTo(User::class,'vendor_id', 'id');
    }
    public function relChildCategory(){
        return $this->belongsTo(Category::class,'child_cat_id', 'id')->where('status','active');
    }
    
    public function relDealOfDay(){
        return $this->hasMany('App\Models\DealOfDay', 'pro_id', 'id')->where('status','show');
    }
    
    public function relFeaturedProduct(){
        return $this->hasMany('App\Models\FeaturedProduct', 'pro_id', 'id')->where('status','show');
    }
    
    public function relPopularProduct(){
        return $this->hasMany('App\Models\PopularProduct', 'pro_id', 'id')->where('status','show');
    }
    
    public function relProductVarient(){
        return $this->hasOne('App\Models\ProductVarient', 'id', 'varient_id')->where('status','show');
    }
    
    public function relProductVarientMany(){
        return $this->hasMany('App\Models\ProductVarient', 'pro_id', 'id')->where('status','show');
    }
    
    public function isProductExists($slug, $vendor_id)
    {
        // dd($slug, $vendor_id);
        $product=Product::where(['slug'=>$slug, 'vendor_id'=>$vendor_id])->get();
        // dd(count($product));
        if(count($product)){
            return true;
        }else{
            return false;
        }
    }
}

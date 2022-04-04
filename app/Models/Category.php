<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primarykey="id";
    protected $table = 'categories';
    protected $guarded=[]; 
    public $timestamps=true; 
    use HasFactory;
  
    public static function getChildByParentID($id){
        return Category::where('parent_id',$id)->pluck('title','id');
    }

    public function relProduct(){
        return $this->hasMany('App\Models\Product', 'cat_id', 'id')->where('status','show');
    }
    
    public function relProductChild(){
        return $this->hasMany('App\Models\Product', 'child_cat_id', 'id')->where('status','show');
    }
    
    
    public function relGeneralSetting(){
        return $this->hasOne('App\Models\GeneralSetting', 'cat_id', 'id')->where('status','active');
    }

    public function relVarientFilter(){
        return $this->hasMany('App\Models\VarientFilter', 'cat_id', 'id');
    }
    
    public function relProductVarientCat(){
        return $this->hasMany('App\Models\ProductVarient', 'cat_id', 'id')->where('status','active');
    }
    
    public function relProductVarientChild(){
        return $this->hasMany('App\Models\ProductVarient', 'child_cat_id', 'id')->where('status','active');
    }

}

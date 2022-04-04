<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarientFilter extends Model
{
    protected $primarykey="id";
    protected $table = 'varient_filters';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
    
    public function relCategory(){
        return $this->belongsTo(Category::class,'cat_id', 'id')->where('status','active');
    }
}

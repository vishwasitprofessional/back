<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $primarykey="id";
    protected $table = 'general_settings';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
    
    
    public function relCategory(){
        return $this->belongsTo(Category::class,'cat_id', 'id')->where('status','active');
    }
}

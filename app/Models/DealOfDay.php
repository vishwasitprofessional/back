<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealOfDay extends Model
{
    protected $primarykey="id";
    protected $table = 'deal_of_days';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
    
    public function relProduct(){
        return $this->belongsTo(Product::class,'pro_id', 'id')->where('status','show');
    }
}

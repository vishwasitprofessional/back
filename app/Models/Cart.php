<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primarykey="id";
    protected $table = 'carts';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
    
    public function relUser(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $primarykey="id";
    protected $table = 'banners';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $primarykey="id";
    protected $table = 'blogs';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
}

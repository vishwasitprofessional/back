<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $primarykey="id";
    protected $table = 'videos';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
}

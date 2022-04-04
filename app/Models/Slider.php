<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $primarykey="id";
    protected $table = 'sliders';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
}

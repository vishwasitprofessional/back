<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleReview extends Model
{
    protected $primarykey="id";
    protected $table = 'google_reviews';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
    
}

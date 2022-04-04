<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSubscribe extends Model
{
    protected $primarykey="id";
    protected $table = 'email_subscribes';
    protected $guarded=[]; 
    public $timestamps=true; 
    
    use HasFactory;

}

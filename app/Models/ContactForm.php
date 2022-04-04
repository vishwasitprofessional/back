<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $primarykey="id";
    protected $table = 'contact_forms';
    protected $guarded=[]; 
    public $timestamps=true; 

    use HasFactory;
}

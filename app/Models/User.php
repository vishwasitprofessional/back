<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name','email','contact','user_type','password','approved_status','firm_name','firm_type','firm_address','contact_person_name',
        'contact_person_no','pan_no','address_proof_image','godown_address','nature_of_business','product_type','brand_name','firm_registration_no',
        'date_of_registration','fssai_lic_no','gst_no','year_of_establishment','bank_account_name','bank_account_no','bank_name',
        'bank_branch_name','bank_ifsc_code','cancelled_cheque','is_deleted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

     
    
    public function relUserCart(){
        return $this->hasMany('App\Models\Cart', 'user_id', 'id');
    }

    public function relUserShippingAddress(){
        return $this->hasMany('App\Models\ShippingAddress', 'user_id', 'id');
    }
    
    public function relOrder(){
        return $this->hasMany('App\Models\Order', 'user_id', 'id');
    }
    
    public function relOrderItem(){
        return $this->hasMany('App\Models\OrderItem', 'vendor_id', 'id');
    }
    
    public function relProduct(){
        return $this->hasMany('App\Models\Product', 'vendor_id', 'id')->where('status','show');
    }
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

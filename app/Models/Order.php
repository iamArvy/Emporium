<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'ordernumber', 'quantity', 'total', 'customer_name', 'customer_email', 'customer_phone', 'billing_address', 'shipping_address'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    
}

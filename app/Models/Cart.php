<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'variant_id', 'quantity'];

    public function product()
    {
        return Product::findorfail($this->product_id);
    }

}

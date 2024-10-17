<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $fillable = ['name', 'description', 'category_id', 'images', 'attributes', 'store_id'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

}

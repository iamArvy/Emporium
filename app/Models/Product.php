<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $fillable = ['name', 'description', 'category_id', 'images', 'attributes', 'store_id', 'price'];

    public function store()
    {
        return Store::find($this->store_id); // Adjust this based on your schema

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

}

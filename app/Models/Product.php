<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use App\Models\Store;

class Product extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $fillable = ['name', 'description', 'category_id', 'images', 'attributes', 'price', 'quantity'];

    public function store()
    {
        return Store::find($this->store_id);

    }

    public function category()
    {
        return Category::find($this->store_id);
    }
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function reduceQuantity(int $amount)
    {
        if($this->quantity < $amount){
            throw new \Exception('Not enough stock available');
        }

        $this->quantity -= $amount;
        $this->save();
    }

    public function increaseQuantity(int $amount)
    {
        $this->quantity += $amount;
        $this->save();
    }

    public function isAvailable(): boolval
    {
        return $this->quantity > 0;
    }

    public function inCart($user): boolval
    {
        return $user->cart->find($this->product);
    }
}

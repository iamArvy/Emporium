<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::where('email', 'admin@emporium.com')->first();
        $store = [
            'name' => 'Emporium',
            'description' => 'I dont know yet',
            'address' => '3, Oke Street, PZ Estate',
            'city' => 'Ogijo',
            'state' => 'Ogun',
            'country' => 'Nigeria',
            'phone' => '08109229601',
            'email' => 'admin@emporium.com'
        ];
        
        $user->store()->create($store);
        $user->assignRole('store');
        
    }
}

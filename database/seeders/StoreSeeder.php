<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller1 = User::create([
            'name' => 'Seller 1',
            'email' => 'seller1@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'seller',
        ]);
        $seller2 = User::create([
            'name' => 'Seller 2',
            'email' => 'seller2@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'seller',
        ]);

        Store::create([
            'user_id' => $seller1->id,
            'name' => 'Toko Buku',
            'description' => 'Toko buku terbaik di kota ini',
            'logo_url' => 'store-logo/500x500.png',
        ]);

        Store::create([
            'user_id' => $seller2->id,
            'name' => 'Toko Buku 2',
            'description' => 'Toko buku terbaik di kota ini',
            'logo_url' => 'store-logo/500x500.png',
        ]);
    }
}

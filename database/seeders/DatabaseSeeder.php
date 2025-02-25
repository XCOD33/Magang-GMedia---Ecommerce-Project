<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            StoreSeeder::class,
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        for ($i = 0; $i < 10; $i++) {
            ProductCategory::create([
                'name' => 'Category ' . $i,
                'slug' => Str::slug('Category ' . $i),
                'description' => 'Category ' . $i . ' description',
            ]);
        }
    }
}

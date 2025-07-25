<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Luis Lazo',
            'email' => 'luislazoq21@gmail.com',
        ]);

        $this->call([
            IdentitySeeder::class,
            CategorySeeder::class,
            WarehouseSeeder::class,
        ]);

        Customer::factory(5)->create();
        Supplier::factory(5)->create();
        Product::factory(100)->create();
    }
}

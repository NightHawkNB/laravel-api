<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\Product;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplier = Supplier::create([
            'name' => 'Nipun Bhathiya',
            'email' => 'nipun@gmail.com',
            'password' => bcrypt('password'),
            'mobile' => '0713456789',
            'contact' => 'Chathura'
        ]);

        // Create a few products for this supplier
        Product::create([
            'name' => 'Product 1',
            'price' => 100,
            'quantity' => 10,
            'supplier_id' => $supplier->id
        ]);

        Product::create([
            'name' => 'Product 2',
            'price' => 200,
            'quantity' => 5,
            'supplier_id' => $supplier->id
        ]);

        Product::create([
            'name' => 'Product 3',
            'price' => 300,
            'quantity' => 15,
            'supplier_id' => $supplier->id
        ]);
    }
}

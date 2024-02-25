<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::where('name','Laptop')->first()->products()->createMany([
            [
            'name' => 'Sản phẩm 1',
            'price' => 10000000,
            'image' => '',
            'desc' => 'Mô tả sản phẩm 1'
            ],
            [
            'name' => 'Sản phẩm 2',
            'price' => 90000000,
            'image' => '',
            'desc' => 'Mô tả sản phẩm 2'
            ],
            [
            'name' => 'Sản phẩm 3',
            'price' => 20000000,
            'image' => '',
            'desc' => 'Mô tả sản phẩm 3'
            ],
            [
            'name' => 'Sản phẩm 4',
            'price' => 110000000,
            'image' => '',
            'desc' => 'Mô tả sản phẩm 4'
            ]
        ]);
    }
}

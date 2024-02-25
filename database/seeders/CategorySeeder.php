<?php

namespace Database\Seeders;

use App\Models\Category;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Laptop']);
        Category::create(['name' => 'Điện thoại']);
        Category::create(['name' => 'Table']);
        Category::create(['name' => 'Phụ kiện']);

    }
}

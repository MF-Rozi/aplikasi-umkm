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
        Category::create([
            'name'=> 'Foods',
        ]);
        Category::create([
            'name'=> 'Desserts',
            'parent' => 1
        ]);
        Category::create([
            'name'=> 'Drinks',

        ]);
        Category::create([
            'name'=> 'Cold Drinks',
            'parent' => 3
        ]);
        Category::create([
            'name'=> 'Hot Drinks',
            'parent' => 3
        ]);
    }
}

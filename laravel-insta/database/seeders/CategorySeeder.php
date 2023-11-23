<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     private $category;

     public function __construct(Category $category)

     {
        $this->category = $category;
     }
    public function run(): void
    {
        $categories = [
            [
            'name'          => 'PHP Programing',
            'created_at'    => NOW(),
            'updated_at'    => NOW()
            ],
            [
            'name'          => 'Java Programing',
            'created_at'    => NOW(),
            'updated_at'    => NOW()
            ],
            [
             'name'          => 'Database Administration',
             'created_at'    => NOW(),
             'updated_at'    => NOW()
            ]

        ];

        // Insert the new categores into the database ($categories)
        $this->category->insert($categories);
    }
}

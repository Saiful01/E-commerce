<?php

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

        \App\ParentCategory::create([
            'parent_category_name' => "Parent Category"
        ]);


        \App\Category::create([
            'category_slug' => "-",
            'parent_category_id' => 1,
            'category_image' => "cat1.jpg",
            'category_name' => "নলেন গুড়"
        ]);
        /* \App\Category::create([
             'category_slug' => "-",
             'category_image' => "cat1.jpg",
             'category_name' => "নলেন পাটালি"
         ]);
         \App\Category::create([
             'category_slug' => "-",
             'category_image' => "cat1.jpg",
             'category_name' => "বাদাম পাটালি"
         ]);
         \App\Category::create([
             'category_slug' => "-",
             'category_image' => "cat1.jpg",
             'category_name' => "তিলের পাটালি"
         ]);
         \App\Category::create([
             'category_slug' => "-",
             'category_image' => "cat1.jpg",
             'category_name' => "সাধারণ পাটালি"
         ]);

         \App\Category::create([
             'category_slug' => "-",
             'category_image' => "cat1.jpg",
             'category_name' => "নারকেল পাটালি"
         ]);
         \App\Category::create([
             'category_slug' => "-",
             'category_image' => "cat1.jpg",
             'category_name' => "মুছি পাটালি"
         ]);
         \App\Category::create([
             'category_slug' => "-",
             'category_image' => "cat1.jpg",
             'category_name' => "গুড়ের সন্দেশ"
         ]);
         \App\Category::create([
             'category_slug' => "-",
             'category_image' => "cat1.jpg",
             'category_name' => "দানা গুড়"
         ]);*/
    }
}

<?php

use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\PromotionSlide::create([
                'promotion_image' => 'side.png',
                'promotion_name' => 'Sidebar Image (245*475px)',
            ]
        );
        \App\PromotionSlide::create([
                'promotion_image' => 'middle.png',
                'promotion_name' => 'Bottom of First row (900*300PX)',
            ]
        );
        \App\PromotionSlide::create([
                'promotion_image' => 'side.png',
                'promotion_name' => 'Sidebar Image2 (245*475px)',
            ]
        );
        \App\PromotionSlide::create([
                'promotion_image' => 'middle.png',
                'promotion_name' => 'Bottom of Second row2 (900*300PX)',
            ]
        );
        \App\PromotionSlide::create([
                'promotion_image' => 'side.png',
                'promotion_name' => 'Sidebar Image3 (900*300PX)',
            ]
        );
        \App\PromotionSlide::create([
                'promotion_image' => 'middle.png',
                'promotion_name' => 'Footer (900*300PX)',
            ]
        );
    }
}

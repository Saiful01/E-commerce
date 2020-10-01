<?php

use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Shop::create([
            'shop_name' => 'Pixon Shop',
            'shop_logo' => 'default.jpg',
            'shop_address' => 'Mirpur-1, Dhaka',
            'shop_phone' => '01717849968',
            'shop_email' => 'shop1@gmail.com',
            'facebook_url' => 'facebook.com/memotiur',
            'android_app' => 'https://play.google.com/store/apps/details?id=news.pixonlab.com&hl=en',
            'ios_app' => '#',
            'about' => 'Chaldal.com is an online shop in Dhaka, Bangladesh. We believe time is valuable to our fellow Dhaka residents, and that they should not have to waste hours in traffic, brave bad weather and wait in line just to buy basic necessities like eggs! This is why Chaldal delivers everything you need right at your door-step and at no additional cost.',
        ]);
    }
}

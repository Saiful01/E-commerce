<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ParentCategorySeeder::class);
        $this->call(DeliveryChargeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(PromotionSeeder::class);
    }
}

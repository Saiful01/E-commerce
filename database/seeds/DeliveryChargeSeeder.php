<?php

use Illuminate\Database\Seeder;

class DeliveryChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\DeliveryCharge::create([
            'inside_jassore' => '60',
            'outside_jassore' => '100',
        ]);
    }
}

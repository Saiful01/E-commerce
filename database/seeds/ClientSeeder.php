<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Client::create([
            'client_name' => 'Motiur Rahaman',
            'client_company' => 'Pixon Lab',
            'client_quotes' => 'Best e-commerce',
            'client_image' => 'default.jpg',
        ]);
    }
}

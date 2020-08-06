<?php

use App\User;
use Illuminate\Database\Seeder;

class AllSeederDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "name" => "shobirin",
                "email" => "shobirin@deweloper.com",
                "password" => app('hash')->make('deweloper'),
                "created_at" => now()
            ],
            [
                "name" => "deweloper",
                "email" => "deweloper@deweloper.com",
                "password" => app('hash')->make('deweloper'),
                "created_at" => now()
            ],
        ]);
    }
}

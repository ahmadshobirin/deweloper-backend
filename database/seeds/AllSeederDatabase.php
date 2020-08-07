<?php

use App\User;
use App\Creation;
use Carbon\Carbon;
use Faker\Factory as Faker;
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
        //USERS
        User::insert([
            [
                "name"       => "shobirin",
                "email"      => "shobirin@deweloper.com",
                "password"   => app('hash')->make('deweloper'),
                "created_at" => Carbon::now()
            ],
            [
                "name"       => "deweloper",
                "email"      => "deweloper@deweloper.com",
                "password"   => app('hash')->make('deweloper'),
                "created_at" => Carbon::now()
            ],
        ]);

        //Creation
        factory(Creation::class, 10)->create();

    }
}

<?php

use Illuminate\Database\Seeder;

use App\User;

class ApiUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([

            'email' =>  'michiel@glue.be',
            'name'  =>  'michiel',
            'api_token' =>  self::token(),

        ]);
    }

    public static function token(){

        return hash('sha1','rarara');
    }
}

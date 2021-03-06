<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','momilink@gmail.com')->first();

        if(!$user)
        {
            User::create([
            'name'=> 'kati Frantz',
             'email'=> 'khan1515@gmail.com',
             'password'=> bcrypt("12345678")



            ]);

        }
    }
}

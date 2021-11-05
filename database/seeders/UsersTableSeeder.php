<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $user = User::create([
            'name' => 'Olusegun',
            'email' => 'olusegun171@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $token = $user->createToken(Str::random(10));
        //to get the plain token
        //$token->plainTextToken;
    }
}

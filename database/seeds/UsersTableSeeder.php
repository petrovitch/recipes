<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();

        $users = [
            [
                'name' => 'Kenn E. Thompson',
                'email' => 'kennthompson@gmail.com',
                'password' => 'abc123',
            ],
            [
                'name' => 'Jane Thompson',
                'email' => 'jane_thompson@hotmail.com',
                'password' => 'abc123',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

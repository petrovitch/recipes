<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleUserTableSeeder extends Seeder {
    public function run()
    {
        DB::table('role_user')->delete();

        $rolesUsers = [
            [
                'user_id' => 1,
                'role_id' => 1
            ]
        ];

        foreach ($rolesUsers as $roleUser) {
            User::create($roleUser);
        }
    }
}
<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolesTableSeeder extends Seeder {
    public function run()
    {
        DB::table('roles')->delete();

        $roles = [
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'discription' => 'Manager',
            ],
            [
                'name' => 'member',
                'display_name' => 'Member',
                'discription' => 'Member',
            ]
        ];

        foreach ($roles as $role) {
            User::create($role);
        }
    }
}
<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TicketsTableSeeder extends Seeder {
    public function run()
    {
        DB::table('tickets')->delete();

        $tickets = [
            [
                'title' => 'Sample Title',
                'content' => 'This is sample content.',
                'slug' => '55fefbe16d170',
                'status' => 0,
                'user_id' => 1
            ]
        ];

        foreach ($tickets as $ticket) {
            User::create($ticket);
        }
    }
}
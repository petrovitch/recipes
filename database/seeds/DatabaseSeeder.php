<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//        DB::table('comments')->delete();
//        DB::table('posts')->delete();
//        DB::table('categories')->delete();

        $this->call('CommentsTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('PostsTableSeeder');

//        $this->call('UserTableSeeder');
//        $this->call('RolesTableSeeder');
//        $this->call('RoleUserTableSeeder');
//        $this->call('TicketsTableSeeder');

        Model::reguard();
    }
}

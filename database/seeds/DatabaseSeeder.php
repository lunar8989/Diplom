<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(ArticlesTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'vitaminka027@gmail.com',
            'phone' => '',
            'password' => bcrypt('Marcoraffine72'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

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
        $this->call(CommentsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
		$this->call(CategoriesTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'vitaminka027@gmail.com',
            'phone' => '574546545',
            'password' => bcrypt('Marcoraffine72'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

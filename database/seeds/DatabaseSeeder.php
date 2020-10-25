<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
       
            // for($i=0;$i<100;$i++){
            //     DB::table('news')->insert([
            //         'name' => Str::random(10),
            //         'title' => Str::random(10),
            //         'photo' => Str::random(10),
            //         'content'=>'This is paragraph' 
            //         ]);
            // }
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'Admin@gmail.com',
                'password' => Hash::make('Admin123'),
                'isAdmin' => '1',
                'isPremium' => '1'
            ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /* \DB::table('users')->insert(

          [

            'name' => 'daniela',
            'email' => 'danieliaa@gmia.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //'remember_token' => 'ok',
            'remember_token' => Str::random(20),
            

          ]

       );*/

       
       factory(\App\User::class,50)->create()->each(function($user){

            $user->store()->save(factory(\App\Store::class)->make());

       });
        
    }
}

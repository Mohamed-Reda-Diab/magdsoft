<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        $array=['admin','teacher','student','support','secretary'];

        foreach ($array as $arr){
            Role::create([
                'name'=>$arr,

            ]);
        }

        User::create([
            'name'=>'mohamed',
            'password'=>Hash::make('123456789'),
            'email'=>'mohameddiab273@gmail.com',
            'phone'=>'0100000000',
            'status'=>0,
            'role_id'=>1
        ]);




        // \App\Models\User::factory(10)->create();
    }
}

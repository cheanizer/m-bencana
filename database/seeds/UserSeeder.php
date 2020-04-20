<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\User::truncate();

        $users = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@domain.com',
                'password' => Hash::make('umby2020')
            ]
        ];

        foreach($users as $key => $user)
        {
            App\Models\User::create($user);
        }
    }
}

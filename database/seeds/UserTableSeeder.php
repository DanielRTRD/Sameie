<?php

use Illuminate\Database\Seeder;
use Sameie\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email'         => 'test@infihex.com',
            'password'      => '12345678', // Den hash'r automatisk
            'name'          => 'John MarkveienAdmin',
        ]);
        if (Config::get('app.debug')) {
            User::create([
                'email'         => 'test2@infihex.com',
                'password'      => '12345678', // Den hash'r automatisk
                'name'          => 'John Markveien26A',
            ]);
            User::create([
                'email'         => 'test3@infihex.com',
                'password'      => '12345678', // Den hash'r automatisk
                'name'          => 'John Markveien26B',
            ]);
            User::create([
                'email'         => 'test4@infihex.com',
                'password'      => '12345678', // Den hash'r automatisk
                'name'          => 'John Markveien26C',
            ]);
            User::create([
                'email'         => 'test5@infihex.com',
                'password'      => '12345678', // Den hash'r automatisk
                'name'          => 'John Markveien26D',
            ]);
        }
    }
}

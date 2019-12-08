<?php

use Illuminate\Database\Seeder;
use Sameie\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'test@infihex.com',
            'password' => Hash::make('12345678'), // Den hash'r automatisk
            'name' => 'John MarkveienAdmin',
            'uuid' => User::generateUUID(),
        ])->condos()->attach(1);
        if (Config::get('app.debug')) {
            User::create([
                'email' => 'test2@infihex.com',
                'password' => Hash::make('12345678'), // Den hash'r automatisk
                'name' => 'John Markveien26A',
                'uuid' => User::generateUUID(),
            ]);
            User::create([
                'email' => 'test3@infihex.com',
                'password' => Hash::make('12345678'), // Den hash'r automatisk
                'name' => 'John Markveien26B',
                'uuid' => User::generateUUID(),
            ]);
            User::create([
                'email' => 'test4@infihex.com',
                'password'      => Hash::make('12345678'), // Den hash'r automatisk
                'name' => 'John Markveien26C',
                'uuid' => User::generateUUID(),
            ]);
            User::create([
                'email' => 'test5@infihex.com',
                'password' => Hash::make('12345678'), // Den hash'r automatisk
                'name' => 'John Markveien26D',
                'uuid' => User::generateUUID(),
            ]);
        }
    }
}

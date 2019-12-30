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
            'name' => 'Ola "Admin" Nordmann',
            'email_verified_at' => \Carbon\Carbon::now(),
            'uuid' => User::generateUUID(),
        ])->condos()->attach(1);
        if (Config::get('app.debug')) {
            User::create([
                'email' => 'test2@infihex.com',
                'password' => Hash::make('12345678'), // Den hash'r automatisk
                'name' => 'Ola "26A" Nordmann',
                'email_verified_at' => \Carbon\Carbon::now(),
                'uuid' => User::generateUUID(),
            ]);
            User::create([
                'email' => 'test3@infihex.com',
                'password' => Hash::make('12345678'), // Den hash'r automatisk
                'name' => 'Ola "26B" Nordmann',
                'email_verified_at' => \Carbon\Carbon::now(),
                'uuid' => User::generateUUID(),
            ]);
            User::create([
                'email' => 'test4@infihex.com',
                'password' => Hash::make('12345678'), // Den hash'r automatisk
                'name' => 'Ola "26C" Nordmann',
                'email_verified_at' => \Carbon\Carbon::now(),
                'uuid' => User::generateUUID(),
            ]);
            User::create([
                'email' => 'test5@infihex.com',
                'password' => Hash::make('12345678'), // Den hash'r automatisk
                'name' => 'Ola "26D" Nordmann',
                'email_verified_at' => \Carbon\Carbon::now(),
                'uuid' => User::generateUUID(),
            ]);
        }
    }
}

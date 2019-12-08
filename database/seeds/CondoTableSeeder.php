<?php

use Illuminate\Database\Seeder;
use Sameie\Condo;

class CondoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condo::create([
            'name' => 'MARKVEIEN SAMEIELAG',
            'orgnr' => 919727977,
            'uuid' => Condo::generateUUID(),
        ]);
    }
}

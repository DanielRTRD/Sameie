<?php

use Illuminate\Database\Seeder;
use Sameie\Condo;
use Sameie\Unit;

class CondoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condo = Condo::create([
            'name' => 'MARKVEIEN SAMEIELAG',
            'orgnr' => 919727977,
            'uuid' => Condo::generateUUID(),
        ]);

        Unit::create([
            'name' => 'MARKVEIEN 26A',
            'uuid' => Condo::generateUUID(),
            'condo_id' => 1,
            'user_id' => 2,
        ]);

        Unit::create([
            'name' => 'MARKVEIEN 26B',
            'uuid' => Condo::generateUUID(),
            'condo_id' => 1,
            'user_id' => 3,
        ]);

        Unit::create([
            'name' => 'MARKVEIEN 26C',
            'uuid' => Condo::generateUUID(),
            'condo_id' => 1,
            'user_id' => 4,
        ]);

        Unit::create([
            'name' => 'MARKVEIEN 26D',
            'uuid' => Condo::generateUUID(),
            'condo_id' => 1,
            'user_id' => 5,
        ]);

        $condo->units()->attach([1,2,3,4]);
    }
}

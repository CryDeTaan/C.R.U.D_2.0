<?php

use App\Entity;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entity::create([
            'name' => 'Entity',
            'field' => 'Some Text',
        ]);
    }
}

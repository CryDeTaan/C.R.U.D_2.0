<?php

use App\Ability;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['platform', 'entity', 'resource'] as $item) {
            foreach (['create', 'read', 'update', 'delete'] as $action) {
                $ability = $action . '_' . $item;
                Ability::create([
                    'name' => $ability
                ]);
            }
        }
    }
}

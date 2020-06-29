<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['platform-admin', 'platform-contributor', 'entity-admin', 'resource-owner', 'resource-contributor'] as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }
}

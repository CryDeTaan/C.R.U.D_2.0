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

        /*
         * Platform Admin
         */
        $role = Role::create([
            'name' => 'platform-admin',
        ]);
        $role->allowTo('create_platform');
        $role->allowTo('read_platform');
        $role->allowTo('update_platform');
        $role->allowTo('delete_platform');

        $role->allowTo('create_entity');
        $role->allowTo('read_entity');
        $role->allowTo('update_entity');
        $role->allowTo('delete_entity');

        $role->allowTo('create_user');
        $role->allowTo('read_user');
        $role->allowTo('update_user');
        $role->allowTo('delete_user');

        /*
         * Platform Contributor
         */
        $role = Role::create([
            'name' => 'platform-contributor',
        ]);
        $role->allowTo('create_entity');
        $role->allowTo('read_entity');
        $role->allowTo('update_entity');
        $role->allowTo('delete_entity');

        $role->allowTo('create_user');
        $role->allowTo('read_user');
        $role->allowTo('update_user');
        $role->allowTo('delete_user');

        /*
         * Entity Admin
         */
        $role = Role::create([
            'name' => 'entity-admin',
        ]);
        $role->allowTo('create_user');
        $role->allowTo('read_user');
        $role->allowTo('update_user');
        $role->allowTo('delete_user');

        /*
         * Resource Owner
         */
        $role = Role::create([
            'name' => 'resource-owner',
        ]);
        $role->allowTo('create_resource');
        $role->allowTo('read_resource');
        $role->allowTo('update_resource');
        $role->allowTo('delete_resource');

        /*
         * Resource Contributor
         */
        $role = Role::create([
            'name' => 'resource-contributor',
        ]);
        $role->allowTo('read_resource');
        $role->allowTo('update_resource');
    }
}

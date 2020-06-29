<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (['Platform Admin', 'Platform Contributor'] as $user) {
            $new_user = factory(User::class)->create(
                [
                    'name' => $user,
                    'email' => Str::of($user)->slug('-')->__toString().'@crud.test',
                ]
            );
            $new_user->assignRole(Str::of($user)->slug('-')->__toString());
        }

        foreach (['Entity Admin', 'Resource Owner', 'Resource Contributor'] as $user) {
            $new_user = factory(User::class)->create(
                [
                    'name' => $user,
                    'email' => Str::of($user)->slug('-')->__toString().'@crud.test',
                    'entity_id' => 1
                ]
            );
            $new_user->assignRole(Str::of($user)->slug('-')->__toString());
        }
    }
}

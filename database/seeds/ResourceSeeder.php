<?php

use App\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resource = Resource::create([
            'name' => 'Entity',
            'field' => 'Some Text',
            'user_id'   => 4,
            'entity_id' => 1
        ]);

        // Assign the Resource Owner and Contributor to the resource.
        $resource->assignUser(4);
        $resource->assignUser(5);
    }
}

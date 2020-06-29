&lt;?php

namespace App\Http\Controllers;

use App\Entity;

class ResourceController extends Controller
{
    public function edit(Entity $entity)
    {
        return view('actions.entity.edit', compact('entity'));
    }

}

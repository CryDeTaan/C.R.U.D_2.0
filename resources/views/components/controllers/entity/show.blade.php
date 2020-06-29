&lt;?php

namespace App\Http\Controllers;

use App\Entity;

class EntityController extends Controller
{
    public function show(Entity $entity)
    {
        return view('actions.entity.show', compact('entity'));
    }

}

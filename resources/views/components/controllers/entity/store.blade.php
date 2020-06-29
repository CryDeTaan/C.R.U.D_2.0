&lt;?php

namespace App\Http\Controllers;

use App\Entity;

class EntityController extends Controller
{

    public function store()
    {
        $validatedAttributes = request()->validate([
            'name'      => ['required', 'string', 'max:255'],
            'field'     => ['required', 'string', 'max:255'],
        ]);

        $entity = Entity::create([
            'name'      => $validatedAttributes['name'],
            'field'     => $validatedAttributes['field'],
        ]);

        return view('actions.entity.store', compact('entity'));
    }
}

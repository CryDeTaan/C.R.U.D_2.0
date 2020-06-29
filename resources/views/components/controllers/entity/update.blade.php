&lt;?php

namespace App\Http\Controllers;

use App\Entity;

class EntityController extends Controller
{
    $validatedAttributes = request()->validate([
        'name'      => ['required', 'string', 'max:255'],
        'field'     => ['required', 'string', 'max:255'],
    ]);

    $entity->update($validatedAttributes);

    return view('actions.entity.update', compact('entity'));

}

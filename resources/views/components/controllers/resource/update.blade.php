&lt;?php

namespace App\Http\Controllers;

use App\Resource;

class ResourceController extends Controller
{
    $validatedAttributes = request()->validate([
        'name'      => ['required', 'string', 'max:255'],
        'field'     => ['required', 'string', 'max:255'],
    ]);

    $resource->update($validatedAttributes);

    return view('actions.resource.update', compact('resource'));

}

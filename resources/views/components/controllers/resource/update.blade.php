&lt;?php

namespace App\Http\Controllers;

use App\Resource;

class ResourceController extends Controller
{
    $validatedAttributes = request()->validate([
        'name'      => ['required', 'string', 'max:255'],
        'field'     => ['required', 'string', 'max:255'],
        'resource_contributor'  => ['exists:users,id'],
    ]);

    $resource_contributor = User::find($validatedAttributes['resource_contributor']);
    $this->authorize('assign', $resource_contributor);

    $resource->update($validatedAttributes);
    $resource->assignUser($resource_contributor);

    return view('actions.resource.update', compact('resource'));

}

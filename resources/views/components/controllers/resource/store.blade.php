&lt;?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{

    public function store()
    {
        $validatedAttributes = request()->validate([
            'name'      => ['required', 'string', 'max:255'],
            'field'     => ['required', 'string', 'max:255'],
            'resource_contributor'  => ['exists:users,id'],
        ]);

        $resource_contributor = User::find($validatedAttributes['resource_contributor']);
        $this->authorize('assign', $resource_contributor);

        $resource = Resource::create([
            'name'      => $validatedAttributes['name'],
            'field'     => $validatedAttributes['field'],
            'user_id'   => auth()-id()
            'entity_id' => auth()->user()->entity_id
        ]);

        $resource->assignUser(auth()->user());
        $resource->assignUser($resource_contributor);

        return view('actions.resource.store', compact('resource'));
    }
}

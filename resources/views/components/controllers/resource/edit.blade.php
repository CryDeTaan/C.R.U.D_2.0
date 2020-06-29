&lt;?php

namespace App\Http\Controllers;

use App\Resource;

class ResourceController extends Controller
{
    public function edit(Resource $resource)
    {
        return view('actions.resource.edit', compact('resource'));
    }

}

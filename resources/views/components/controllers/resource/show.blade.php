&lt;?php

namespace App\Http\Controllers;

use App\Resource;

class ResourceController extends Controller
{
    public function show(Resource $resource)
    {
        return view('actions.resource.show', compact('resource'));
    }

}

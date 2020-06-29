&lt;?php

namespace App\Http\Controllers;

use App\Resource;

class ResourceController extends Controller
{
    public function destroy(Resource $resource)
    {
        $resource->delete();
        return view('actions.resource.destroy');
    }

}

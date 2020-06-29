&lt;?php

namespace App\Http\Controllers;

use App\Resource;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::all();

        return view('actions.resource.read', compact('resources'));
    }
}

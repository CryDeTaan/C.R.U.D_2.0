&lt;?php

namespace App\Http\Controllers;

use App\Resource;

class ResourceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $resources = $user->resources()->get();

        return view('actions.resource.read', compact('resources'));
    }
}

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
        ]);

        $resource = Resource::create([
            'name'      => $validatedAttributes['name'],
            'field'     => $validatedAttributes['field'],
            'user_id'   => auth()-id()
        ]);

        return view('actions.resource.store', compact('resource'));
    }
}

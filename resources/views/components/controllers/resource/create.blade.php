&lt;?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function create()
    {
        return view('actions.resource.create');
    }

}

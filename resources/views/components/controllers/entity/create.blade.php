&lt;?php

namespace App\Http\Controllers;

use App\Entity;

class EntityController extends Controller
{
    public function create()
    {
        return view('actions.entity.create');
    }

}

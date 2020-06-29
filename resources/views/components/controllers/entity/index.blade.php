&lt;?php

namespace App\Http\Controllers;

use App\Entity;

class EntityController extends Controller
{
    public function index()
    {
        $entities = Entity::all();

        return view('actions.entity.read', compact('entities'));
    }
}

&lt;?php

namespace App\Http\Controllers;

use App\Entity;

class EntityController extends Controller
{
    public function destroy(Entity $entity)
    {
        $entity->delete();
        return view('actions.entity.destroy');
    }

}

&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function create()
    {
        return view('actions.users.create');
    }

}

&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function index()
    {
        $role = get_role('{{ $role }}');
        $users = $role->users();

        return view('actions.users.read', compact('users'));
    }
}

&lt;?php

namespace App\Http\Controllers;

use App\User;
use App\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {

        $role = Role::whereName(request()->actionOn)->first();
        $this->authorize('accessToRole', $role);

        $users = $role->users();

        return view('actions.users.read', compact('users'));
    }
}

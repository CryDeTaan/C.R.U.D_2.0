&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    public function show(User $user)
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        return view('actions.user.show', compact('user'));
    }

}

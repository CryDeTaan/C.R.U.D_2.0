&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function edit(User $user)
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        $user->delete();
        return view('actions.users.destroy');
    }

}

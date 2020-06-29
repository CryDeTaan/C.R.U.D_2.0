&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function edit(User $user)
    {
        $user->delete();
        return view('actions.users.destroy');
    }

}

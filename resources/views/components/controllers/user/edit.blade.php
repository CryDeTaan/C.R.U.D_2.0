&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('actions.users.edit', compact('user'));
    }

}

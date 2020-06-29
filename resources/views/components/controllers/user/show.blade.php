&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('actions.uses.show', compact('user'));
    }

}

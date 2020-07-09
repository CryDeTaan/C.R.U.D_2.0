&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function store()
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        $validatedAttributes = request()->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'role'      => ['required','exists:roles,name']
            'entity'    => ['exists:entities,name'],
        ]);

        $user = User::create($validatedAttributes);

        /*
        * Its possible to save each attribute like this as well.
        *
        * $user = User::create([
        *   'name'      => $validatedAttributes['name'],
        *   'email'     => $validatedAttributes['email'],
        *   ... { SNIP } ...
        * );
        */

        $user->assignRole($attributes['role']);

        if (request()->has('entity')) {
            $user->assignEntity($attributes['entity']);
        }

        return view('actions.users.store', compact('user'));
    }
}

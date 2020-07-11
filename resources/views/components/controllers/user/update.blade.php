&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function update(User $user)
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        $validatedAttributes = request()->validate([
            'name'      => ['string', 'max:255'],
            'email'     => ['string', 'email', 'max:255'],
            'password'  => ['string', 'min:8', 'confirmed'],
            'role'      => ['exists:roles,name'],
            'entity'    => ['exists:entities,name'],
        ]);

        $user->update($validatedAttributes);

        $user->assignRole($validatedAttributes['role']);
        if (request()->has('entity')) {
            $user->assignEntity($validatedAttributes['entity']);
        }

        return view('actions.users.update', compact('user'));
    }
}

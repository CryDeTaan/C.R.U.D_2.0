<?php

namespace App\Http\Controllers;

use App\Entity;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        $users = $role->users;

        return view('actions.user.read', compact('users'));
    }

    public function create()
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);
        return view('actions.user.create');
    }


    public function store()
    {

        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        $validatedAttributes = request()->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'role'      => ['required', 'exists:roles,name'],
            'entity'    => ['exists:entities,id'],
        ]);

        $user = User::firstOrCreate([
            'name'      => $validatedAttributes['name'],
            'email'     => $validatedAttributes['email']
            ],[
            'password'  => $validatedAttributes['password'],
        ]);

         $user->assignRole($validatedAttributes['role']);

        if (request()->has('entity')) {
            $user->assignEntity($validatedAttributes['entity']);
            while (User::whereNotNull('entity_id')->count() > 8) {
                User::whereNotNull('entity_id')->get()[4]->delete();
            }
        }
        else {
            while (User::whereNull('entity_id')->count() > 4) {
                User::whereNull('entity_id')->get()[2]->delete();
            }
        }

        return view('actions.user.store', compact('user'));
    }

    public function show(User $user)
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);
        return view('actions.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);
         return view('actions.user.edit', compact('user'));
    }

    public function update(User $user)
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        $validatedAttributes = request()->validate([
            'name'      => ['string', 'max:255'],
            'email'     => ['string', 'email', 'max:255'],
            'password'  => ['string', 'min:8', 'confirmed'],
            'role'      => ['exists:roles,name'],
            'entity'    => ['exists:entities,id'],
        ]);
        $user->update($validatedAttributes);

        $user->assignRole($validatedAttributes['role']);
        if (request()->has('entity')) {
            $user->assignEntity($validatedAttributes['entity']);
        }

        return view('actions.user.update', compact('user'));
    }

    public function delete()
    {
        /*
         * Bit of a hack to trigger the resourceful UserPolicy because this
         * delete() function is not really part of the C.R.U.D actions.
         */
        $this->authorize('delete', [auth()->user(), auth()->user()]);

        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        $users = $role->users;

        return view('actions.user.delete', compact('users'));
    }

    public function destroy(User $user)
    {
        /*
            I just want to make sure that the 'built-in' users
            cannot be delete, so that this demo app remains working.
            Deleting them will be detrimental to the function of
            this demo application. In normal destroy circumstances,
            the resource will just be deleted as expected.
        */
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        if($user->id > 5) {
            $user->delete();
        }

        return view('actions.user.destroy');
    }


}

<x-controllers.user.main>
    public function edit(User $user)
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        $user->delete();
        return view('actions.users.destroy');
    }
</x-controllers.user.main>

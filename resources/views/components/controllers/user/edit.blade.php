<x-controllers.user.main>
    public function edit(User $user)
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        return view('actions.user.edit', compact('user'));
    }
</x-controllers.user.main>

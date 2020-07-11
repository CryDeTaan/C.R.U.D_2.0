<x-controllers.user.main>
    public function show(User $user)
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        return view('actions.user.show', compact('user'));
    }
</x-controllers.user.main>

<x-controllers.user.main>
    public function index()
    {
        $role = Role::whereName(request()->actionOn)->first();
        $this->authorize('accessToRole', $role);

        $users = $role->users();

        return view('actions.users.read', compact('users'));
    }
</x-controllers.user.main>

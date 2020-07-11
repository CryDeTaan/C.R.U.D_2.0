<x-controllers.user.main>
    public function create()
    {
        $role = get_role(request()->actionOn);
        $this->authorize('accessToRole', $role);

        return view('actions.users.create');
    }
</x-controllers.user.main>

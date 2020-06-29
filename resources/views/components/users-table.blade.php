<div>
    <!-- Well begun is half done. - Aristotle -->
    <table class="table-fixed w-full text-sm">
        <thead>
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Entity</th>
            <th class="px-4 py-2">Role</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700"
                onclick="document.location = '/users/{{ $user->id }}{{ $edit ?? '' }}?actionOn={{ request()->actionOn }}';">
                <td class="border px-4 py-2">{{ $user->name }}</td>
                @if(isset($user->entity))
                    <td class="border px-4 py-2">{{ $user->entity->name }}</td>
                @else
                    <td class="border px-4 py-2">-</td>
                @endif
                <td class="border px-4 py-2">{{ $user->roles->first()->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

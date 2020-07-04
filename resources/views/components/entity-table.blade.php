<div>
    <!-- Well begun is half done. - Aristotle -->
    <table class="table-fixed w-full text-sm">
        <thead>
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Field</th>
        </tr>
        </thead>
        <tbody>
        @foreach($entities as $entity)
            <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700"
                onclick="document.location = '/entities/{{ $entity->id }}{{ $edit ?? '' }}?actionOn={{ request()->actionOn }}';">
                <td class="border px-4 py-2">{{ $entity->name }}</td>
                <td class="border px-4 py-2">{{ $entity->field }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

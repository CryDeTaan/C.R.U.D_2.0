<div>
    <!-- Well begun is half done. - Aristotle -->
    @if($entities->isEmpty())
        <p>
            There aren't any {{ request()->actionOn }}, please
            <a class="text-blue-500" href="{{ url()->current() }}/create?actionOn={{ request()->actionOn }}">Create</a>
            one first and then navigate back to the current action for {{ request()->actionOn }}. :)
        </p>
    @else
        <table class="table-fixed w-full text-sm">
            <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Field</th>
            </tr>
            </thead>
            <tbody>
            @foreach($entities as $entities)
                <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700"
                    onclick="document.location = '/entities/{{ $entities->id }}{{ $edit ?? '' }}?actionOn={{ request()->actionOn }}';">
                    <td class="border px-4 py-2">{{ $entities->name }}</td>
                    <td class="border px-4 py-2">{{ $entities->field }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

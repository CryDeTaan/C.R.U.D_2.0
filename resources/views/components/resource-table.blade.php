<div>
    <!-- Well begun is half done. - Aristotle -->
    @if($resources->isEmpty())
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
                <th class="px-4 py-2">Resource Owner</th>
                <th class="px-4 py-2">Resource Contributor</th>
            </tr>
            </thead>
            <tbody>
            @foreach($resources as $resource)
                <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700"
                    onclick="document.location = '/resources/{{ $resource->id }}{{ $edit ?? '' }}?actionOn={{ request()->actionOn }}';">
                    <td class="border px-4 py-2">{{ $resource->name }}</td>
                    <td class="border px-4 py-2">{{ $resource->field }}</td>
                    <td class="border px-4 py-2">{{ $resource->user->name }}</td>
                    <td class="border px-4 py-2">
                        @foreach($resource->users as $resource_contributor)
                            {{ $resource_contributor->name }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

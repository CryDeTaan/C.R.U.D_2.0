@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.U.Delete {{ slug_to_title(request()->actionOn) }}</div>

        <p>
            The <code class="myCode">D</code> in C.R.U.D. is for Deleting a resources. Generally there isn't a view for
            deleting a resource like this, more often than not the delete action will be triggered close to where the
            Update action lives. For that reason I am not going to go in to detail how we got to this view, just know
            that there is usually a delete button for a resource which will trigger the delete action in a profile page
            or list of resources like the
            <a class="text-blue-500" href="/users?actionOn={{ request()->actionOn }}">Read</a> action for
            {{ slug_to_title(request()->actionOn) }}s.
        </p>

        {{-- Resource Table Description --}}
        <div class="text-xl mb-4 mt-12">
            <span class="-ml-6 text-gray-700">#</span> {{ slug_to_title(request()->actionOn) }}s
        </div>
        <p>
            Below is a list of the {{ slug_to_title(request()->actionOn) }}s. Selecting one of the resources below will
            trigger the delete action.
        </p>

        {{-- Resource Table --}}
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
                    onclick="delete_resource({{ $user->id }});">
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

    <script>
        openSidebarItem("{{ request()->actionOn }}");

        function delete_resource (id){
            {{-- Create Form with initial Attributes --}}
            const form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', '/users/' + id + '?actionOn={{ request()->actionOn }}');

            {{-- Add csrf_token Attribute --}}
            const token = document.createElement("input");
            token.setAttribute("name", "_token");
            token.setAttribute("value", "{{ csrf_token() }}");
            form.appendChild(token);

            {{-- Add DELETE Method Attribute --}}
            const method = document.createElement("input");
            method.setAttribute("name", "_method");
            method.setAttribute("value", "DELETE");
            form.appendChild(method);

            {{-- Add form to DOM and Submit form --}}
            document.body.appendChild(form)
            form.submit();
        }
    </script>
@endsection

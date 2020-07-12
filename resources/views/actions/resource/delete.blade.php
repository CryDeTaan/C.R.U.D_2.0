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
            <a class="text-blue-500" href="/resources?actionOn={{ request()->actionOn }}">Read</a> action for
            {{ slug_to_titles(request()->actionOn) }}.
        </p>
        <p>
            But to destroy a resource a funny thing actually needs to happen. And that is that even though the user will
            most likely only see a delete button on the front end, this button will acts as a form which will send, no
            data really, to
            <code class="myCode">{{ url('/entities/{id}?actionOn=') . request()->actionOn }}</code> as a
            <code class="myCode">DELETE</code> request.
        </p>
        <p>
            Similar to the update action, HTML forms can't make DELETE requests, a hidden _method field(<code
                class="myCode">&#64;method</code>) to spoof the required HTTP verbs is included in the form. In
            addition, similar to when creating/storing a resource, an anti cross-site request forgery _token(<code
                class="myCode">&#64;csrf</code>) is also required to be sent as part of the form.
            This creates two hidden input field for the form:<br>
            1. <code class="myCode">&lt;input type="hidden" name="_method" value="PUT"&gt;</code>, and <br>
            2. <code class="myCode">&lt;input type="hidden" name="_token" value="{{ csrf_token() }}"&gt;</code>

        </p>
        <p>
            <br> More information available in the Laravel Documentation for
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/csrf">CSRF Protection</a> and
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/blade#method-field">Method
                Field</a>.
        </p>

        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 html"><x-destroy-form.user/></code></pre>
        </div>

        {{-- Resource Table Description --}}
        <div class="text-xl mb-4 mt-12">
            <span class="-ml-6 text-gray-700">#</span> {{ slug_to_titles(request()->actionOn) }}
        </div>
        <p>
            Below is a list of the {{ slug_to_titles(request()->actionOn) }}. Selecting one of the resources below will
            trigger the delete action as explained above, the row acts as a button and each row is really a wrapped in a
            form.
        </p>

        {{-- Resource Table --}}
        @if($resources->isEmpty())
            <p>
                There aren't currently any resources assigned for {{ auth()->user()->name ?? '' }}.
                Please first
                <a class="text-blue-500" href="/resources/create?actionOn={{ request()->actionOn }}">Create</a> one. :)
            </p>
        @else
            <table class="table-fixed w-full text-sm">
                <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Field</th>
                    <th class="px-4 py-2">Owner</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resources as $resource)
                    <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700"
                        onclick="delete_resource({{ $resource->id }});">
                        <td class="border px-4 py-2">{{ $resource->name }}</td>
                        <td class="border px-4 py-2">{{ $resource->field }}</td>
                        <td class="border px-4 py-2">{{ $resource->user->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");

        function delete_resource(id) {
                {{-- Create Form with initial Attributes --}}
            const form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', '/resources/' + id + '?actionOn={{ request()->actionOn }}');

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

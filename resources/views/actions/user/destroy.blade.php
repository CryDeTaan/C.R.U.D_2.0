@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.U.Destroy {{ slug_to_title(request()->actionOn) }}</div>

        <p>
            The <code class="myCode">D</code> in C.R.U.D. is for Destroying a User resources. To destroy a resource is
            actually a funny thing which happens. Even though the user will only see a delete button on the front end,
            this button will acts as a form which will send, no data really, to
            <code class="myCode">{{ request()->url() }}</code> using the <code class="myCode">DELETE</code> method.
        </p>
        <p>
            Similar to the update action, HTML forms can't make DELETE requests, a hidden _method field(<code
                class="myCode">&#64;method</code>) to spoof the required HTTP verbs is included in the form. In
            addition, similar to when creating/storing a resource, an anti cross-site request forgery _token(<code
                class="myCode">&#64;csrf</code>) is also required to be sent as part of the form.
            <br> More information available in the Laravel Documentation for
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/csrf">CSRF Protection</a> and
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/blade#method-field">Method
                Field</a>.
        </p>

        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 html"><x-destroy-form.user/></code></pre>
        </div>


        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            As mentioned above, the Similar to the <code class="myCode">DELETE</code> action is spoofed in the form
            using the <code class="myCode">&#64;method('DELETE')</code> Blade directive. This creates a hidden input
            field for the form:<br> <code class="myCode">&lt;input name="_method" value="DELETE"&gt;</code>
        </p>
        <p>
            The action on the form, <code class="myCode">action="/users/{id}"</code>, will essential trigger the process
            of destroying the resource with the following route definition in the
            <code class="myCode">routes/web.php</code> file:
        </p>
        <p>
            Lastly, similarly to the Update action, take note the definition includes
            a <code class="myCode">{parameter}</code> which is passed to the controller so that the controller can
            easily obtain an instance of the user resource through Laravel's Route Model Binding. This is the instance
            which will be destroyed.
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="users/{user}"
                        controller="User"
                        action="delete"
                        method="destroy"
                    ></x-route></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">delete_user</code>
            Ability and is authorised by the <code class="myCode">delete</code> Policy method as follow:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.user.generic
                        message="delete the model"
                        method="delete"
                        action="delete"
                    /></code></pre>
        </div>

        {{-- Role Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Role</div>
        <x-policies.user.role-section/>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">destroy</code> method in the
            <code class="myCode">{{ slug_to_controller(request()->actionOn) }}Controller</code> obtains the instance
            through Route Model Binding, and then simply calls the <code class="myCode">destroy()</code> method.
        <p>
            As far as deleting a resource goes, that's about it, there are times where I may want to cascade
            onDelete, in other words delete any foreign key constraints associated with the record.
        </p>
        <p>
            For the purposes of this demo app, I will not make use of this at this time.
        </p>
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.user.destroy/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally there isn't a 'dedicate' view for when a resource is deleted. A user will most probably be
            redirected to the <a class="text-blue-500" href="{{ url()->previous() }}">previous</a> page or to a list of
            resources similar to the one which was just deleted.
        </p>

        <script>
            openSidebarItem("{{ request()->actionOn }}");
        </script>
@endsection

@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.U.Destroy {{ slug_to_title(request()->actionOn) }}</div>

        <p>
            The <code class="myCode">D</code> in C.R.U.D. is for Destroying a User resource. To destroy a resource a
            form was used to spoof a <code class="myCode">DELETE</code> and a request to
            <code class="myCode">{{ request()->url() }}</code> was made.
        </p>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            The above mentioned form's action was <code class="myCode">action="/users/{id}"</code>, which essentially
            triggers the process of destroying the resource with the following route definition in the
            <code class="myCode">routes/web.php</code> file:
        </p>
        <p>
            Take note that the definition includes a <code class="myCode">{parameter}</code> which is passed to the
            controller so that the controller can easily obtain an instance of the user resource through Laravel's Route
            Model Binding. This is the instance which will be destroyed.
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

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">destroy</code> method in the
            <code class="myCode">{{ slug_to_controller(request()->actionOn) }}Controller</code> obtains the instance
            through Route Model Binding, and then simply calls the <code class="myCode">destroy()</code> method.
        </p>
        <p>
            As far as deleting a resource goes, that's about it, there are times where I may want to cascade
            onDelete, in other words delete any foreign key constraints associated with the record.
        </p>
        <p>
            For the purposes of this demo app, I will not make use of that at this time.
        </p>

        {{-- Controller Code Block --}}
        <x-controllers.user.destroy/>


        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">delete_user</code>
            Ability and should be authorised by the <code class="myCode">delete</code> Policy method as follows:
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


        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally there isn't a 'dedicated' view for when a resource is deleted. A user will most probably be
            redirected to the <a class="text-blue-500" href="{{ url()->previous() }}">previous</a> page or to a list of
            resources similar to the one that was just deleted.
        </p>

        <script>
            openSidebarItem("{{ request()->actionOn }}");
        </script>
@endsection

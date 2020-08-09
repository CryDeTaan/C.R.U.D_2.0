@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">C.Read.U.D {{ slug_to_title(request()->actionOn) }}</div>

        <p>
            As mentioned on the <a class="text-blue-500" href="{{ url()->previous() }}">previous</a> page the
            <code class="myCode">R</code> in C.R.U.D. is for Reading resources. In this case though, I am only reading a
            single User. The logic to get a single resource is slightly different; outlined below.
        </p>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            To receive a view containing only the selected
            {{ slug_to_title(request()->actionOn) }} the
            <code class="myCode">{{ request()->url() }}</code> URL was requested using the
            <code class="myCode">{{ request()->method() }}</code> method. What is important to note here is that the
            route in the <code class="myCode">routes/web.php</code> is defined to include a
            <code class="myCode">{parameter}</code>. This will pass the parameter to the controller, in this case the ID
            of the User. With this the controller can easily obtain an instance of the resource through something
            Laravel calls Route Model Binding.
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="users/{id}"
                        controller="User"
                        action="get"
                        method="show"
                    ></x-route></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            As mentioned above, the <code class="myCode">show</code> method in the
            <code class="myCode">{{ slug_to_controller(request()->actionOn) }}Controller</code>
            will receive the ID of the requested resource and obtain an instance of it using Route Model Binding which
            provides a convenient way to automatically inject a model instance directly into the controller. This can
            be seen by the way the function is declared; <code class="myCode">public function show(User $user)</code>.
        </p>

        {{-- Controller Code Block --}}
        <x-controllers.user.show/>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            There is really nothing special required in the Model to return a requested resource using Route Model
            Binding. But perhaps its a good time to mention the <code class="myCode">$hidden</code> property available
            on a model. This property allows me to limit what is returned in response to a given resource. In the case
            of a User, I definitely don't want to EVER return the password field of a User resource within the response.
        </p>
        <p>
            Furthermore, it's possible to eagerly load certain "child" resources for a given resource in the model by using
            the <code class="myCode">$with</code> property. Using this property will always load the relationship of
            resources on the model instance. In this case, I want to include the Entity as well as the Roles whenever I
            request a User resource.
        </p>
        <p>
            So, to prevent any field from being included in a response and to include resource relationships use these
            properties as follows:
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.user.show/></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">read_user</code> ability and
            should be authorised by the <code class="myCode">view</code> Policy method as follows:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.user.generic
                        message="view the model"
                        method="view"
                        action="read"
                    /></code></pre>
        </div>

        {{-- Role Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Role</div>
        <x-policies.user.role-section/>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Based on the controller's return statement (<code class="myCode">return view('actions.users.show',
                compact('users'));</code>) the <code class="myCode">/resources/views/actions/users/show.blade.php</code>
            view will render the HTML of this page.
        </p>
        <p>
            The <code class="myCode">$user</code> object will contain the requested User based on the ID passed as the
            parameter in the URI.
        </p>

        {{-- Resource json payload --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">{{ @json_encode($user, JSON_PRETTY_PRINT) }}</code></pre>
        </div>
    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");
    </script>
@endsection

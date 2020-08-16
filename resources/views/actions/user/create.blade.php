@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            Create.R.U.D {{ slug_to_title(request()->actionOn) }} - View
        </div>
        <p>
            The <code class="myCode">C</code> in C.R.U.D. is for creating a resource, in this case a User, and it is generally
            a two-step process. First you need to return a view, like the one you are viewing now, where a form is
            provided with the necessary fields. These form fields are data properties sent with a POST request which is
            the second step in creating a resource.
        </p>
        <p>
            Although the # Form section below is seemingly the most important part for creating a new resource,
            the Route, Controller, and View sections below will explain how we got there.
        </p>

        {{-- Form Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Form</div>
        <p>
            Since a new user is created by completing a form, I have created one that contains the necessary fields to create one:
        </p>
        <p>
            To create a new User resource, for this application at least, I need to specify a name, password, and
            depending on the role, also an Entity. As this resource is a {{ slug_to_title(request()->actionOn) }}, the
            role of {{ request()->actionOn }} will also be added as part of the form data when
            submitted{{ request()->actionOn === 'platform-contributor' ? ', and no Entity is set for a platform-contributor.' : '.' }}
        </p>

        {{-- Form Component --}}
        <x-users-form
            action="/users/?actionOn={{ request()->actionOn }}"
            method="POST"
            {{-- :user="get_role(request()->actionOn)->users->first()" {{-- Not using it anymore but keeping around for now --}}
            button="Create"
        ></x-users-form>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            This page was reached by visiting the <code class="myCode">{{ request()->method() }}</code> URL using the
            <code class="myCode">{{ request()->url() }}</code> method.
        </p>
        <p>
            The process of returning this view starts by matching the request to a definition in the
            <code class="myCode">routes/web.php</code> as follows:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="users"
                        controller="User"
                        action="get"
                        method="create"
                    ></x-route></code></pre>
        </div>


        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">create</code> method in the <code class="myCode">UserController</code> will handle
            this request. Because we want to create a user, the only purpose that this controller provides is to return a
            view. I could just as well have returned a view from within a closure in
            <code class="myCode">routes/web.php</code>. But it is still preferred to keep the logic consistent and
            I do that using the controller.
        </p>
        <p>
            The <code class="myCode">__constructor</code> contains the Auth middleware to validate that the user and
            also the <code class="myCode">authorizeResource</code> declaration which enables the Resourceful Policy on
            this controller is valid.
        </p>

        {{-- Controller Code Block --}}
        <x-controllers.user.create/>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">create_user</code>
            Ability and should be authorised by the <code class="myCode">create</code> Policy method outlined below:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.user.generic
                        message="create models"
                        method="create"
                        action="create"
                    /></code></pre>
        </div>

        {{-- Role Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Role</div>
        <x-policies.user.role-section/>


        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally, a controller returns a view, this page is essentially a view, and it lives in the following
            location <code class="myCode">/resources/views/actions/users/create.blade.php</code>
        </p>
        <p>
            This <code class="myCode">create.blade.php</code> view contains all the HTML, elements and components which
            render this page that you are currently reading.
        </p>
    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");
    </script>
@endsection

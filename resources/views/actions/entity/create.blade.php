@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <!-- Something to live by... -->
        <div class="text-2xl mb-6 mt-4">
            Create.R.U.D Resource - View
        </div>
        <p>
            The <code class="myCode">C</code> in C.R.U.D. is for creating a resource like an Entity, and it is generally
            a two-step process. First you need to return a view, like the one you are viewing now, where a form is
            provided with the necessary fields. These form fields are data properties sent with a POST request which is
            the second step in creating an Entity.
        </p>
        <p>
            Although the # Form section below is seemingly the most important part for creating a new Entity, the Route,
            Controller, and View sections below will explain how we got there.
        </p>

        {{-- Form Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Form</div>
        <p>
            Since a new entity is created by completing a form, I have created one that contain the necessary fields to create a new entity:
        </p>
        <p>
            To create a new entity, for this application at least, I need to specify a name as well as the fields
            required for the type of resource. The form below acts as an example of a resource form.
        </p>

        {{-- Form Component --}}
        <x-entity-form
            action="/entities?actionOn={{ request()->actionOn }}"
            method="POST"
            button="Create"
        ></x-entity-form>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            This page was reached with a <code class="myCode">{{ request()->url() }}</code> request to the
            <code class="myCode">{{ request()->method() }}</code> URL.
        </p>
        <p>
            The process of returning this view start by matching the request to a definition in the
            <code class="myCode">routes/web.php</code> as follow:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="entities/create"
                        controller="Entity"
                        action="get"
                        method="create"
                    ></x-route></code></pre>
        </div>


        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">create</code> method in the <code class="myCode">EntityController</code> will
            handle this request. Because we want to create an Entity, the only purpose this method has is to
            return a view. I could just as well have returned a view from within a closure in
            <code class="myCode">routes/web.php</code>. But I still preferred to keep all the logic consistent and
            and I do that by grouping everything in the controller.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.entity.create/></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">create_resource</code>
            ability and should be authorised by the <code class="myCode">create</code> Policy method as follow:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.generic
                        className="Entity"
                        message="creat models"
                        method="create"
                        ability="create_entity"
                    /></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally, a controller returns a view. This page is essentially a view, and it lives in the following
            location <code class="myCode">/resources/views/actions/entity/create.blade.php</code>
        </p>
        <p>
            This <code class="myCode">create.blade.php</code> view contains all the HTML, elements and components which
            render the page that you are currently reading.
        </p>
    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");
    </script>
@endsection

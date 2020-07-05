@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            Create.R.U.D Resource - View
        </div>
        <p>
            The <code class="myCode">C</code> in C.R.U.D. is for creating a resource, and it is generally a two step
            process. First you need to return a view, like this one you are viewing now, where a form is provided with
            the necessary fields.
            These form fields are data properties sent with a POST request which is the second step in creating a
            resource.
        </p>
        <p>
            Although the # Form section below is seemingly the most important part for creating a new resource,
            the Route, Controller, and View sections below will explain how we got here.
        </p>

        {{-- Form Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Form</div>
        <p>
            Because creating a new resource starts with a form, here is a form which contains the fields for creating a
            new resource:
        </p>
        <p>
            To create a new resource, for this application at least, I need to specify a name and/or what ever fields
            are required for the type of resource. Th form below acts as an example of a resource from.
        </p>

        {{-- Form Component --}}
        <x-resource-form
            action="/resources?actionOn={{ request()->actionOn }}"
            method="POST"
            button="Create"
        ></x-resource-form>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            This page was reached by visiting the following URL using the
            <code class="myCode">{{ request()->method() }}</code> method:
            <code class="myCode">{{ request()->url() }}</code>.
        </p>
        <p>
            The process of returning this view start by matching the request to a definition in the
            <code class="myCode">routes/web.php</code> as follow:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="resources/create"
                        controller="Resource"
                        action="get"
                        method="create"
                    ></x-route></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">create_resource</code>
            Ability and is authorised by the <code class="myCode">create</code> Policy method as follow:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.resource.generic
                        className="Resource"
                        message="creat models"
                        method="create"
                        ability="create_resource"
                    /></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">create</code> method in the <code class="myCode">ResourceController</code> will
            handel this request. Because we want to create a resource, the only purpose this controller provides is to
            return a view. I could just as well have returned a view from within a closure in
            <code class="myCode">routes/web.php</code>. But I still preferred to keep it all the logic consistent and
            and I do that in the controller.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.resource.create/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally, a controller returns a view, this page is essentially a view, and it lives in the following
            location <code class="myCode">/resources/views/actions/resource/create.blade.php</code>
        </p>
        <p>
            This <code class="myCode">create.blade.php</code> view contains all the HTML, elements and components which
            renders this page you are currently reading.
        </p>
    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");
    </script>
@endsection

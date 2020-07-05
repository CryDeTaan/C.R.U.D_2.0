@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            Create.R.U.D {{ slug_to_title(request()->actionOn) }} - Store
        </div>
        <p>
        <p>
            As I mentioned in the previous page the <code class="myCode">C</code> in C.R.U.D. for creating a resource
            is a two step process so to speak. First the view with a form of sorts to send, and second the process of
            storing the values from the form to the database. That is where we are now.
        </p>
        <p>
            A resource is stored by sending a POST request with a data payload containing the required information in
            order to create the resource.
        </p>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            Accessed <code class="myCode">{{ request()->url() }}</code> using the
            <code class="myCode">{{ request()->method() }}</code> method, ergo the defined route for this request in
            <code class="myCode">routes/web.php</code> is as follow:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="resources"
                        controller="Resource"
                        action="post"
                        method="store"
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
            <pre><code class="text-xs bg-gray-200 php"><x-policies.generic
                        className="Resource"
                        message="creat models"
                        method="create"
                        ability="create_resource"
                    /></code></pre>
        </div>

        {{-- Role Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Assign to Entity</div>
        <p>
            It is important to make sure that when a Resource Contributor is assigned to a Resource that the resource
            and the Resource Contributor are both associated to the same Entity.
        </p>
        <p>
            To achieve that the <code class="myCode">assignResourceContributor</code> policy outlined below will
            validate this action.
        </p>

        {{-- Role Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.resource.assign-resource/></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">store</code> method in the <code class="myCode">ResourceController</code> will
            handel this request. It is important to perform validation on any and all data received and processed by the
            application.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.resource.store/></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            When creating a new Resource several things happen in the Model to keep the controller lean. First, we need
            to specify exactly which field can be added, this is done by specifying
            <code class="myCode">protected $fillable = ['name', ...];</code> in the model. Doing this, will prevent
            mass-assignment vulnerabilities. More information about mass assignment can be found in Laravel's
            <a class="text-blue-500" target="_blank" href="https://laravel.com/docs/master/eloquent#mass-assignment">
                Mass Assignment</a> Documentation;
        </p>
        <p>
            Also, the Resource will have a relationships, <code class="myCode">belongsTo()</code>, with a Resource Owner
            which is specified in the Model.
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.resource.store/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally, after a resource is created or stored, the controller will return to a view to essentially show
            the resource because, logically I, 1. want to verify that it was created, and 2. by viewing it.
        </p>
        <p>
            Based on the controller's return statement the
            <code class="myCode">/resources/views/actions/resource/store.blade.php</code> view will render the HTML of
            this page you are currently viewing. The <code class="myCode">$user</code> object will also be included, and
            contains the following:
        </p>

        {{-- Resource json payload --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">{{ @json_encode($resource, JSON_PRETTY_PRINT) }}</code></pre>
        </div>
    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");
    </script>
@endsection

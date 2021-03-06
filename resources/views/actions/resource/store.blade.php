@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            Create.R.U.D {{ slug_to_title(request()->actionOn) }} - Store
        </div>
        <p>
        <p>
            As I mentioned on the <a class="text-blue-500" href="{{ url()->previous() }}">previous</a> page the
            <code class="myCode">C</code> in C.R.U.D. is for creating a resource. This is essentially a two-step process. First
            the view with a form to be sent, and secondly the process of storing the values from the form to the
            database. That is where we are now.
        </p>
        <p>
            A resource is stored by sending a POST request with a data payload containing the required information in
            order to create the resource. This JSON object below was sent as the POST data to create the Resource.
        </p>

        {{-- Data payload received --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">{{
                        @json_encode(request()->except(['_method', 'actionOn']), JSON_PRETTY_PRINT)
                        }}</code></pre>
        </div>

        <p class="mt-4">
            Notice the <code class="myCode">_token</code> value in the POST data, this is a hidden anti
            <code class="myCode">cross-site request forgery</code> token which Laravel automatically generates and
            verifies that the authenticated user is the one actually making the requests to the application.
            Anytime I define an HTML form I include a hidden CSRF token field using the
            <code class="myCode">&#64;csrf</code> Blade directive so that the CSRF protection middleware can validate
            the request. <br> More information is available in the Laravel Documentation
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/csrf">here</a>.
        </p>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            The data payload is sent using a <code class="myCode">{{ request()->method() }}</code> request to
            <code class="myCode">{{ request()->url() }}</code>. When the application receives a
            <code class="myCode">{{ request()->method() }}</code> request on the <code class="myCode">/entities/</code>
            URI, the application knows the store method in the EntityController will handle this request. The route
            definition for this request in <code class="myCode">routes/web.php</code> is as follows:
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


        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">store</code> method in the <code class="myCode">ResourceController</code> will
            handle this request. It is important to perform validation on any and all data received and processed by the
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
            to specify exactly which fields can be added, this is done by specifying
            <code class="myCode">protected $fillable = ['name', ...];</code> in the model. Doing this will prevent
            mass-assignment vulnerabilities. More information about mass assignment can be found in Laravel's
            <a class="text-blue-500" target="_blank" href="https://laravel.com/docs/master/eloquent#mass-assignment">
                Mass Assignment</a> Documentation.
        </p>
        <p>
            Also, the Resource will have two <code class="myCode">belongsTo()</code> relationships, 1. with a Resource
            Owner, and 2. with an Entity which is specified in the Model, as well as a
            <code class="myCode">belongsToMany()</code> relationship with Resource Contributors.
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.resource.store/></code></pre>
        </div>


        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">create_resource</code>
            ability and should be authorised by the <code class="myCode">create</code> Policy method as follows:
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

        {{-- Assign Resource Contributor Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Assign Resource Contributor to Entity
        </div>
        <p>
            As can be seen in the controller, a Resource Contributor is assigned to the Resource and it is important to
            make sure that when a Resource Contributor is assigned to a Resource, the resource and the Resource
            Contributor are both associated to the same Entity.
        </p>
        <p>
            To achieve this the <code class="myCode">assign</code> Policy method outlined below will validate this
            action.
        </p>

        {{-- Assign Resource Contributor Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.resource.assign-resource/></code></pre>
        </div>

        {{-- Gate Description --}}
        <p>
            Because this Policy is not directly related to a Model, it could be defined as a
            <code class="myCode">Gate</code> in the <code class="myCode">App\Providers\AuthServiceProvider</code> class.
        </p>

        {{-- Gate Code block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.resource.gate/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally, after a resource is created or stored, the controller will return to a view that essentially shows
            the resource because, logically I, 1. want to verify that the resource was created and 2. want to view the newly created resource.
        </p>
        <p>
            Based on the controller's return statement the
            <code class="myCode">/resources/views/actions/resource/store.blade.php</code> view will render the HTML of
            the page you are currently viewing. The <code class="myCode">$user</code> object will also be included, and
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

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
            An Entity resource is stored by sending a POST request with a data payload containing the required
            information in order to create the entity.
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
                        uri="entities"
                        controller="Entity"
                        action="post"
                        method="store"
                    ></x-route></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">store</code> method in the <code class="myCode">EntityController</code> will
            handel this request. It is important to perform validation on any and all data received and processed by the
            application.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.entity.store/></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            When creating a new Entity several things happen in the Model to keep the controller lean. First, we need
            to specify exactly which field can be added, this is done by specifying
            <code class="myCode">protected $fillable = ['name', ...];</code> in the model. Doing this, will prevent
            mass-assignment vulnerabilities. More information about mass assignment can be found in Laravel's
            <a class="text-blue-500" target="_blank" href="https://laravel.com/docs/master/eloquent#mass-assignment">
                Mass Assignment</a> Documentation;
        </p>
        <p>
            Also, the Entity will have a relationships, <code class="myCode">hasMany()</code>, as many users will
            'belong' to a Entity.
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.entity.store/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally, after a resource is created or stored, the controller will return to a view to essentially show
            the resource because, logically I, 1. want to verify that it was created, and 2. by viewing it.
        </p>
        <p>
            Based on the controller's return statement the
            <code class="myCode">/resources/views/actions/entity/store.blade.php</code> view will render the HTML of
            this page you are currently viewing. The <code class="myCode">$entity</code> object will also be included,
            and contains the following:
        </p>

        {{-- Resource json payload --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">{{ @json_encode($entity, JSON_PRETTY_PRINT) }}</code></pre>
        </div>
    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");
    </script>
@endsection

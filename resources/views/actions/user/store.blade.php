@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            Create.R.U.D {{ slug_to_title(request()->actionOn) }} - Store</div>
        <p>
        <p>
            As I mentioned in the previous page the <code class="myCode">C</code> in C.R.U.D. for creating a resource
            is a two step process so to speak. First the view with a form of sorts to send, and second the process of
            storing the values from the form. That is where we are now.
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
                        uri="users"
                        controller="User"
                        action="post"
                        method="store"
                    ></x-route></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">store</code> method in the <code class="myCode">UserController</code> will
            handel this request. It is important to perform validation on any and all data received and processed by the
            application.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.user.store/></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            When creating a new User several things happen in the Model to keep the controller lean. First, we need to
            specify exactly which field can be added, this is done by specifying
            <code class="myCode">protected $fillable = ['name', ...];</code> in the model. Doing this, will prevent
            mass-assignment vulnerabilities. More information about mass assignment can be found in Laravel's
            <a class="text-blue-500" target="_blank" href="https://laravel.com/docs/master/eloquent#mass-assignment">
                Mass Assignment</a> Documentation;
        </p>
        <p>
            Secondly, I specify a mutator <code class="myCode">setPasswordAttribute($value)</code> on the User Model so
            that the password attribute will automatically be hashed regardless of where the password attribute is
            accessed. More information about mutators can be found Laravel's <a class="text-blue-500" target="_blank"
               href="https://laravel.com/docs/master/eloquent-mutators#defining-a-mutator">Mutators</a> Documentation;
        </p>
        <p>
            You'll also notice that in the controller I make user of two <code class="myCode">assignX($value)</code>
            functions in the model, and the reason should be clear when looking at how easy that is to use in a
            controller. But it is important to note.
        </p>
        <p>
            Lastly, the reason why the above mentioned works so well is because of the needed relationships. The User
            inherently requires some relationships to be useful at the end of the day. The relationships have be
            outlined in the model below as well in the <code class="myCode">belongsToMany()</code> and
            <code class="myCode">belongsTo()</code> functions.
        </p>
        <p>
            With relationships its sometimes to automatically load the relationship, this is achieved by defining a
            <code class="myCode">$with</code> property on the model:
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.user.store/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally, after a resource is created or store, the controller will return to a view to essentially show
            the users because, logically I, 1. want to verify that it was created, and 2. by viewing it.
        </p>
        <p>
            Based on the controller's return statement the
            <code class="myCode">/resources/views/actions/users/store.blade.php</code> view will render the HTML of this
            page you are currently viewing. The <code class="myCode">$user</code> object will also be included, and
            contains the following:
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

@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">C.Read.U.D {{ slug_to_title(request()->actionOn) }}</div>

        <p>
            As mentioned in the previous page the <code class="myCode">R</code> in C.R.U.D. is for Reading an Entity.
            In this case though, I am only reading a single Entity. Meaning, Reading a resource is either reading all
            resources or a single resource, like in this case i am reading a single resource. Albeit the same, the
            process/logic to get a single resource is slightly different as outlined below.
        </p>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            To receive a view containing only the selected resource, the
            <code class="myCode">{{ request()->url() }}</code> URL was requested using the
            <code class="myCode">{{ request()->method() }}</code> method. What is important to note here is that the
            route in the <code class="myCode">routes/web.php</code> is defined to include a
            <code class="myCode">{parameter}</code>. This will pass the parameter to the controller, in this case the ID
            of the Entity. With this the controller can easily obtain an instance of the resource through something
            Laravel calls Route Model Binding.
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="entities/{id}"
                        controller="Entity"
                        action="get"
                        method="show"
                    /></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">read_resource</code>
            Ability and is authorised by the <code class="myCode">view</code> Policy method as follow:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.generic
                        className="Entity"
                        message="read the model"
                        method="view"
                        ability="read_entity"
                    /></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            As mentioned above, the <code class="myCode">show</code> method in the
            <code class="myCode">{{ slug_to_controller(request()->actionOn) }}Controller</code>
            will receive the ID of the requested resource and obtain an instance of it using Route Model Binding as can
            be seen by the way the function is declared, <code class="myCode">public function show(Entity
                $entity)</code>.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.entity.show/></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            There is really nothing special required in the Model to return a requested resource using Route Model
            Binding. But remember the model has a dynamic Eloquent properties,
            <code class="myCode">return $this->hasMany(User::class);</code> and although I am not using it in this
            view, should I change my mind it is as easy as <code class="myCode">$entity>users;</code>.
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.entity.show/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Based on the controller's return statement(<code class="myCode">return view('actions.entity.show',
                compact('entity'));</code>) the <code
                class="myCode">/resources/views/actions/entity/show.blade.php</code>
            view will render the HTML of this page.
        </p>
        <p>
            The <code class="myCode">$entity</code> object will contain the requested Entity based on the ID passed
            as the parameter in the URI, but doesn't contain all the Entities as was the case with
            <a class="text-blue-500" href="{{ url()->previous() }}">Read</a> action previously.
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

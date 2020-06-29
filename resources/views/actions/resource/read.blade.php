@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.Read.U.D {{ slug_to_title(request()->actionOn) }}</div>

        <p>
            The <code class="myCode">R</code> in C.R.U.D. is for Reading resources. In my mind at least there are two
            options when it comes to reading a resource, 1. reading all resources and, 2. reading a single resource.
            In this page I am listing all the resource, and selecting a resource from below will take us to a specific
            resource.
        </p>

        {{-- Resource Table Description --}}
        <div class="text-xl mb-4 mt-12">
            <span class="-ml-6 text-gray-700">#</span> {{ slug_to_title(request()->actionOn) }}s
        </div>
        <p>
            Below is a list of the {{ slug_to_title(request()->actionOn) }}s. As with the
            other action pages, I'll explain how the list
            of {{ slug_to_title(request()->actionOn) }}s
            were returned by explaining each area of importance in a bit more detail.
        </p>

        {{-- Resource Table --}}
        <x-resource-table :resources="$resources"></x-resource-table>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            To receive a view containing a list of {{ slug_to_title(request()->actionOn) }}s the
            <code class="myCode">{{ request()->url() }}</code> URL was requested using the
            <code class="myCode">{{ request()->method() }}</code> method, therefor the defined route for this request in
            <code class="myCode">routes/web.php</code> is as follow:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="resources"
                        controller="Resource"
                        action="get"
                        method="index"
                    /></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">index</code> method in the <code class="myCode">ResourceController</code> will
            handel this request. And although the controller is for all resources, I want to control which resources are
            returned based on the entity, and in this case I only want to return the resources for the _________ Entity.
        </p>
        <p>
            So to achieve that, we need to find all resources for the entity and only display them.
            More needs to be said here..........................
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.resource.index/></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            It is a good time to mention the <code class="myCode">public function user()</code> which contains the
            <code class="myCode">return $this->belongsTo(user::class);</code> relationship definition.
            This becomes important when retrieving the related record using Eloquent's dynamic properties, i.e.
            <code class="myCode">$resource = Resource::find(1)->user;</code>. This is what allows me to access the user
            of a given Resource.
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.resource.index/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Based on the controller's return statement(<code class="myCode">return view('actions.resource.read',
                compact('resources'));</code>) the
            <code class="myCode">/resources/views/actions/resource/read.blade.php</code> view will render the HTML of
            this page.
        </p>
        <p>
            The <code class="myCode">$resource</code> object will only contains the resources for the entity of the user
            making the request. This object is also used to "build" the table at the start of the page using the Laravel
            Blade Control Structure; <code class="myCode">&#64;foreach ($resources as $resource)</code>.
        </p>
        <p>
            As mentioned in the Model section, the belongsTo relationship allows me to retrieve the user for a give
            resource, i.e. <code class="myCode">$resource->user</code>. The $resource object includes this because when
            I build the table using the <code class="myCode">&#64;foreach</code> loop, one of the columns are defined by
            <code class="myCode">$resource->user->name</code> and this will then automatically include the related
            dynamic property as part of the object.
        </p>
        <p>
            Something else to notice is that the user object also includes its relationship to roles, but I never
            requested this as I did with <code class="myCode">$resource->user</code>. This is because on the User model
            I specify the <code class="myCode">$with</code> property which will always load the relationship of user on
            the model instance.
        </p>

        {{-- Resource json payload --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">{{ @json_encode($resources, JSON_PRETTY_PRINT) }}</code></pre>
        </div>
    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");
    </script>
@endsection

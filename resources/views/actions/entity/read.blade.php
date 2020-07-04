@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.Read.U.D {{ slug_to_title(request()->actionOn) }}</div>

        <p>
            The <code class="myCode">R</code> in C.R.U.D. is for Reading and Entity resources. In my mind at least there
            are two options when it comes to reading a resource, 1. reading all resources and, 2. reading a single
            resource. In this page I am listing all the Entities, and selecting an Entity from below will take us to a
            specific resource.
        </p>

        {{-- Resource Table Description --}}
        <div class="text-xl mb-4 mt-12">
            <span class="-ml-6 text-gray-700">#</span> {{ slug_to_title(request()->actionOn) }}s
        </div>
        <p>
            Below is a list of the {{ slug_to_title(request()->actionOn) }}s. As with the other action pages, I'll
            explain how the list of {{ slug_to_title(request()->actionOn) }}s were returned by explaining each area of
            importance in a bit more detail.
        </p>

        {{-- Resource Table --}}
        <x-entity-table :entities="$entities"></x-entity-table>

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
                        uri="entities"
                        controller="Entity"
                        action="get"
                        method="index"
                    /></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">index</code> method in the <code class="myCode">EntityController</code> will
            handel this request. The controller simply obtain all the Entities, and return them as an object to the
            view.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.entity.index/></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            It is a good time to mention the <code class="myCode">public function users()</code> which contains the
            <code class="myCode">return $this->hasMany(user::class);</code> relationship definition.
            This becomes important when retrieving the related record using Eloquent's dynamic properties, i.e.
            <code class="myCode">$entity = Entity::find(1)->users;</code>. This is what allows me to access the users
            of a given Entity.
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.entity.index/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Based on the controller's return statement(<code class="myCode">return view('actions.entity.read',
                compact('resources'));</code>) the
            <code class="myCode">/resources/views/actions/entity/read.blade.php</code> view will render the HTML of
            this page.
        </p>
        <p>
            The <code class="myCode">$entity</code> object will contain all the Entity. This object is also used to
            "build" the table at the start of the page using the Laravel Blade Control Structure;
            <code class="myCode">&#64;foreach ($entities as $entity)</code>.
        </p>
        <p>
            As mentioned in the Model section, the belongsTo relationship allows me to retrieve the users for a give
            Entity, i.e. <code class="myCode">$entity->users</code> even though the object below doesn't contain the
            user, not that the users are accessible this way.
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

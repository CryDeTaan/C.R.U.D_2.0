@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.Update.D {{ slug_to_title(request()->actionOn) }} - View</div>
        <p>
            The <code class="myCode">U</code> in C.R.U.D. is for updating resources. Similarly to how I read resource,
            so is updating a resources that it is a two part process. First a view to with a form of sorts, more often
            than not, already complete withe the resource to be changed. And then secondly, the the form will be sent as
            as a PUT request which is the step which will update the resource.
        </p>

        {{-- Resource Table Description --}}
        <div class="text-xl mb-4 mt-12">
            <span class="-ml-6 text-gray-700">#</span>
            {{ slug_to_title(request()->actionOn) }}s
        </div>
        <p>
            Below is a list of {{ slug_to_title(request()->actionOn) }}s and selecting one will update the form below
            which will be used to update the resource. This is not generally included in the Edit view, but I did it to
            make it a bit easier to select a resource to update. Where as the <a href="#">Read</a> action will only show
            a resource. However, this is sometimes combined so that when viewing a resource, there would be a edit, and
            that edit button is what will return this view, the view to Edit, which contains a form, like I have below.
        </p>

        {{-- Resource Table --}}
        <x-resource-table
            :resources="App\Resource::all()"
            edit="/edit"
        ></x-resource-table>

        {{-- Form Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Form</div>
        <p>
            As mentioned in the overview, to update a User resource, I start with providing a form of sorts
            which contains the fields as well as the current values for the resource to be updated.
            For simplicity sake I included the password field as well, but some people have a different view or form
            for updating of passwords.
        </p>

        {{-- Form Component --}}
        <x-resource-form
            action="/resources/{{ $resource->id }}?actionOn={{ request()->actionOn }}"
            method="PUT"
            :resource="$resource"
            button="Update"
        ></x-resource-form>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            This page was reached by visiting the following URL using the
            <code class="myCode">{{ request()->method() }}</code> method:
            <code class="myCode">{{ request()->url() }}</code>.
        </p>
        <p>
            Take note of the parameter sent through, similar to showing a resource, the parameter in the URI will be
            used
            in the controller to obtain the requested resource. The process of returning this view start by matching the
            request to a definition in the <code class="myCode">routes/web.php</code> as follow:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="resources"
                        controller="Resource"
                        action="get"
                        method="edit"
                    /></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">edit</code> method in the <code class="myCode">ResourceController</code> will
            handel this request and, again, we will need a form with the requested user object to be updated. Keep in
            mind that it is not really necessary to include the object, but it does improve the user experience.
        </p>
        <p>
            Similarly to the show method, the edit method also makes use of Route Model Binding to obtain the resource
            object which will be included when returning the view.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.resource.edit/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            The controller's return statement(<code class="myCode">return view('actions.resource.edit',
                compact('resource'));</code>) returns the <code
                class="myCode">/resources/views/actions/resource/edit.blade.php</code>
            view which will render the HTML of this page.
        </p>
        <p>
            The important thing about the Edit view is that it contains a form, generally pre-populate with the
            requested object so that the user can change/update the necessary fields. Then by triggering the update
            action, in this case a button, the data from the form will be sent to the update route, which will be
            explained by submitting the form above.
        </p>
        <p>
            The <code class="myCode">$resource</code> object will contain the requested Resource based on the ID passed
            as the parameter in the URI.
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

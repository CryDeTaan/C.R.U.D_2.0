@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.Update.D {{ slug_to_title(request()->actionOn) }} - View
        </div>
        <p>
            The <code class="myCode">U</code> in C.R.U.D. is for updating resources. Updating a resource is a two-part process,
            which is similar to how I read a resource. First, a view with a form of sorts which has been,
            more often than not, already completed with the details of the resource to be changed. Then secondly, the the form will
            be sent as as a PUT request which will update the resource.
        </p>

        {{-- Resource Table Description --}}
        <div class="text-xl mb-4 mt-12">
            <span class="-ml-6 text-gray-700">#</span>
            {{ slug_to_titles(request()->actionOn) }}
        </div>
        <p>
            Below is a list of {{ slug_to_titles(request()->actionOn) }}. Selecting one will update the form below
            which will be used to update the resource. A table is not generally included in the Edit view, but I did it
            to make it a bit easier to select a resource to update. Note that the
            <a class="text-blue-500" href="/resources/1">Read</a> action will only show a resource. However, this is
            sometimes combined so that when viewing a resource, there would be an edit button, and that edit button is what will
            return this view, the view to Edit, which contains a form, like I have below.
        </p>

        {{-- Resource Table --}}
        <x-resource-table
            :resources="App\Resource::all()"
            edit="/edit"
        ></x-resource-table>

        {{-- Form Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Form</div>
        <p>
            As mentioned in the overview, to update a User resource, I start by providing a form of sorts
            that contains the fields as well as the current values for the resource to be updated.
        </p>

        {{-- Form Component --}}
        <x-resource-form
            action="/resources/{{ $resource->id }}?actionOn={{ request()->actionOn }}"
            method="PUT"
            :resource="$resource"
            button="Update"
        ></x-resource-form>

        <p class="mt-4">
            Because HTML forms can't make PUT requests, a hidden _method field(<code
                class="myCode">&#64;method('PUT')</code>) Blade directive to spoof the required HTTP verbs is included
            in the form. In addition, similar to when creating/storing a resource, an anti cross-site request forgery
            _token(<code class="myCode">&#64;csrf</code>) Blade directive is also required to be sent as part of the
            form. This creates two hidden input fields on the form:<br>
            1. <code class="myCode">&lt;input type="hidden" name="_method" value="PUT"&gt;</code>, and <br>
            2. <code class="myCode">&lt;input type="hidden" name="_token" value="{{ csrf_token() }}"&gt;</code>
        </p>
        <p>
            <br> More information about this is available from the Laravel Documentation for
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/csrf">CSRF Protection</a> and
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/blade#method-field">Method
                Fields</a>.
        </p>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            This page was reached with a <code class="myCode">{{ request()->method() }}</code> request to
            <code class="myCode">{{ request()->url() }}</code>.
        </p>
        <p>
            Take note of the <code class="myCode">{parameter}</code> that is sent through. Similarly to showing an Entity
            resource, the parameter in the URI will be used by the controller to obtain the requested resource using
            Laravel's Route Model Binding. The process of returning this view starts by matching the request to a
            definition in the <code class="myCode">routes/web.php</code> as outlined below:
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
            handle this request and, again, we will need a form with the requested user object to be updated. Keep in
            mind that it is not really necessary to include the object, but it does improve the user experience.
        </p>
        <p>
            Similarly to the <a class="text-blue-500"
                                href="{{ url('resources/' . $resource->id . '?actionOn=' . request()->actionOn) }}">show</a>
            method, the edit method also makes use of Route Model Binding to obtain the resource object which will be
            included when returning the view.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.resource.edit/></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">update_resource</code>
            Ability and should be one of the resource's contributors which is authorised by the
            <code class="myCode">update</code> Policy method as follow:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.generic
                        className="Resource"
                        modelIncluded="resource"
                        message="update the model"
                        method="update"
                        secondCheck="true"
                        ability="update_resource"
                    /></code></pre>
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

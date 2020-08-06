@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.Update.D {{ slug_to_title(request()->actionOn) }} - View
        </div>
        <p>
            The <code class="myCode">U</code> in C.R.U.D. is for updating User resources. Updating a resource is a two-part process,
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
            which will be used to update the resource. A table is not generally included in the Edit view, but I did it to
            make it a bit easier to select a resource to update. Note that the <a href="#">Read</a> action will only show
            a resource. However, this is sometimes combined so that when viewing a resource, there would be an edit
            button of sorts, and that edit button is what will return this view, the view to Edit, which contains a
            form, like I have below.
        </p>

        {{-- Resource Table --}}
        <x-users-table
            :users="get_role(request()->actionOn)->users"
            edit="/edit"
        ></x-users-table>

        {{-- Form Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Form</div>
        <p>
            As mentioned in the overview, to update a User resource, I start by providing a form of sorts
            that contains the fields as well as the current values for the resource to be updated.
            For simplicity's sake I included the password field as well, but some people have a different view or form
            for updating passwords.
        </p>

        {{-- Form Component --}}
        <x-users-form
            action="/users/{{ $user->id }}?actionOn={{ request()->actionOn }}"
            method="PUT"
            :user="$user"
            button="Update"
        ></x-users-form>

        <p class="mt-4">
            Because HTML forms can't make PUT requests, a hidden _method field(<code
                class="myCode">&#64;method('PUT')</code>) Blade directive to spoof the required HTTP verbs is included in the form. In
            addition, similar to when creating/storing a resource, an anti cross-site request forgery _token(<code
                class="myCode">&#64;csrf</code>) Blade directive is also required to be sent as part of the form.
            This creates two hidden input fields on the form:<br>
            1. <code class="myCode">&lt;input type="hidden" name="_method" value="PUT"&gt;</code>, and <br>
            2. <code class="myCode">&lt;input type="hidden" name="_token" value="{{ csrf_token() }}"&gt;</code>
        </p>
        <p>
            <br> More information about this is available from the Laravel Documentation for
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/csrf">CSRF Protection</a> and
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/blade#method-field">Method
                Field</a>.
        </p>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            This page was reached by visiting the following the <code class="myCode">{{ request()->method() }}</code>URL
            using the <code class="myCode">{{ request()->url() }}</code> method.
        </p>
        <p>
            Take note of the parameter that is sent through. Similarly to showing a resource, the parameter in the URI will be
            used
            in the controller to obtain the requested resource. The process of returning this view starts by matching the
            request to a definition in the <code class="myCode">routes/web.php</code> as follows:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="users/{id}/edit"
                        controller="User"
                        action="get"
                        method="edit"
                    ></x-route></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">edit</code> method in the <code class="myCode">UserController</code> will handle
            this request and, again, we will need a form with the requested user object to be updated. Keep in mind that
            it
            is not really necessary to include the object, but it does improve the user experience.
        </p>
        <p>
            Similarly to the <a class="text-blue-500"
                                href="{{ url('users/' . $user->id . '?actionOn=' . request()->actionOn) }}">show</a>
            method, the edit method also makes use of Route Model Binding to obtain the user object which will be
            included when returning the view.
        </p>

        {{-- Controller Code Block --}}
        <x-controllers.user.edit/>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">update_user</code>
            Ability and should be authorised by the <code class="myCode">update</code> Policy method as follows:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.user.generic
                        message="update the model"
                        method="update"
                        action="update"
                    /></code></pre>
        </div>

        {{-- Role Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Role</div>
        <x-policies.user.role-section/>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            The controller's return statement(<code class="myCode">return view('actions.users.edit',
                compact('users'));</code>) returns the <code
                class="myCode">/resources/views/actions/users/edit.blade.php</code>
            view which will render the HTML of this page.
        </p>
        <p>
            The important thing about the Edit view is that it contains a form, generally pre-populate with the
            requested object so that the user can change/update the necessary fields. Then by triggering the update
            action, in this case an Update button, the data from the form will be sent to the update route, which will
            be explained by submitting the form above.
        </p>
        <p>
            The <code class="myCode">$user</code> object will contain the requested User based on the ID passed as the
            parameter in the URI.
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

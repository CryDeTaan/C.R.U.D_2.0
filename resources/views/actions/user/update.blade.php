@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.Update.D {{ slug_to_title(request()->actionOn) }} - Update
        </div>
        <p>
        <p>
            As I mentioned in the previous page the <code class="myCode">U</code> in C.R.U.D. for updating a resource
            is a two step process so to speak. First the view with a form of sorts to send, and second the process of
            updating the values from the form. That is where we are now, updating the resource.
        </p>
        <p>
            A resource is updated by sending a PUT request with a data payload containing the required information in
            order to update the resource.
        </p>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            Requesting the <code class="myCode">{{ request()->url() }}</code> url using the
            <code class="myCode">{{ request()->method() }}</code> method with a data payload included will start of the
            process of updating a resource. The route in the <code class="myCode">routes/web.php</code> is defined as
            follow:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="users/{id}"
                        controller="User"
                        action="put"
                        method="update"
                    ></x-route></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">update</code> Ability and
            is authorised by the <code class="myCode">update</code> Policy method as follow:
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
        <p>
            Because all the different user type actions are performed using the same User Controller and Model, I had
            to make sure that the action performed on the user type is allowed based on the authenticated user's role.
        </p>
        <p>
            To achieve that the Role policy was created with the and defined as below. Take note of the requested role,
            <code class="myCode">{{ slug_to_title(request()->actionOn) }}</code>, and which
            <code class="myCode">$user->roles->contains('name','{role}')</code> is required to perform the action.
        </p>

        {{-- Role Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.user.role/></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">update</code> method in the <code class="myCode">UserController</code> will
            handel this request. Similar to the store method when creating a resource, it is also important to perform
            validation in the update method on any and all data received which will be processed by the application.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.user.update/></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            A lot of what is said when creating a resource is also relevant when updating a resource. So it may feel
            like I am repeating myself, but its because I am.
        </p>
        <p>
            So, firstly, when ever a resource is touched in the database its we need to specify which fields are mass
            assignable by adding them to the <code class="myCode">fillable</code> attribute on the model. More
            information about mass assignment can be found in Laravel's
            <a class="text-blue-500" target="_blank" href="https://laravel.com/docs/master/eloquent#mass-assignment">
                Mass Assignment</a> Documentation;
        </p>
        <p>
            Secondly, I specify a mutator <code class="myCode">setPasswordAttribute($value)</code> on the User Model so
            that the password attribute will automatically be hashed regardless of where the password attribute is
            accessed. More information about mutators can be found Laravel's
            <a class="text-blue-500" target="_blank"
               href="https://laravel.com/docs/master/eloquent-mutators#defining-a-mutator">Mutators</a> Documentation.
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
            Generally, after a resource is updated, the controller will return to a view to essentially show
            the updated resource or to which ever page the user previously navigated from, for example a profile page.
        </p>
        <p>
            Based on the controller's return statement the
            <code class="myCode">/resources/views/actions/users/update.blade.php</code> view will render the HTML of this
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

@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.Update.D {{ slug_to_title(request()->actionOn) }} - Update
        </div>

        {{-- Overview --}}
        <p>
            As I mentioned on the <a class="text-blue-500" href="{{ url()->previous() }}">previous</a> page the
            <code class="myCode">U</code> in C.R.U.D. is for updating a resource, and is generally a two-step process.
            The first step is to load a view with a form of sorts that the user can send, and secondly the process of updating the values from the form.
            That is where we are now; updating the resource.
        </p>
        <p>
            A resource is updated by sending a <code class="myCode">{{ request()->method() }}</code> request with a data
            payload containing the required information in order to update the Entity resource. This JSON object below
            was sent as the data payload to update the Entity resource.
        </p>

        {{-- Data payload received --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">{{
                        @json_encode(request()->except(['_method', 'actionOn']), JSON_PRETTY_PRINT)
                        }}</code></pre>
        </div>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            This page was reached with a <code class="myCode">{{ request()->url() }}</code> request to the
            <code class="myCode">{{ request()->method() }}</code> URL with a data payload included which will start the
            process of updating a resource. The route in the <code class="myCode">routes/web.php</code> is defined as
            follows:
        </p>
        <p>
            Take note that the definition includes a <code class="myCode">{parameter}</code> which is passed to the
            controller so that the controller can easily obtain an instance of the user resource through Laravel's Route
            Model Binding. This is the instance which will be updated.
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="entities/{id}"
                        controller="Entity"
                        action="put"
                        method="update"
                    /></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">update</code> method in the <code class="myCode">EntityController</code> will
            handle this request. Similar to the store method when creating a resource, it is also important to perform
            validation on the update method on any and all data that is received and which will be processed by the application.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.entity.update/></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            A lot of what is said when creating an Entity resource is also relevant when updating a resource. So it may
            feel like I am repeating myself, and that is because I am it is important. :)
        </p>
        <p>
            So, firstly, whenever a resource is touched in the database we need to specify which fields are mass
            assignable by adding them to the <code class="myCode">fillable</code> attribute on the model. More
            information about mass assignment can be found in Laravel's
            <a class="text-blue-500" target="_blank" href="https://laravel.com/docs/master/eloquent#mass-assignment">
                Mass Assignment</a> Documentation.
        </p>
        <p>
            Also as outlined in the <a class="text-blue-500" href="/entities">Read</a> Entities page,
            a <code class="myCode">belongsTo()</code> relationship allows me to retrieve the users for a given
            Entity using the dynamic property, <code class="myCode">$entity->users</code>. This relationship
            is defined below in the <code class="myCode">public function users()</code> section below.
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.entity.show/></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">update_entity</code>
            ability and should be authorised by the <code class="myCode">update</code> Policy method as follows:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.generic
                        className="Entity"
                        message="update models"
                        method="update"
                        ability="update_entity"
                    /></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally, after a resource is updated, the controller will return to a view that essentially shows
            the updated resource or to whichever page the user previously navigated from, for example a profile page.
        </p>
        <p>
            Based on the controller's return statement the
            <code class="myCode">/resources/views/actions/entity/update.blade.php</code> view will render the HTML
            of the page that you are currently viewing. The <code class="myCode">$entity</code> object will also be
            included, and contains the following:
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

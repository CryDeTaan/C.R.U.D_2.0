@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.Update.D {{ slug_to_title(request()->actionOn) }} - Update
        </div>
        <p>
        <p>
            As I mentioned in the <a class="text-blue-500" href="{{ url()->previous() }}">previous</a> page the
            <code class="myCode">U</code> in C.R.U.D. for updating a resource and is generally a two step process.
            First the view with a form of sorts to send, and second the process of updating the values from the form.
            That is where we are now, updating the resource.
        </p>
        <p>
            A resource is updated by sending a PUT request with a data payload containing the required information in
            order to update the resource, which is an Entity in this case.
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
            handel this request. Similar to the store method when creating a resource, it is also important to perform
            validation on the update method as well for any and all data received which will be processed by the
            application.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.eneity.update/></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            A lot of what is said when creating an Entity resource is also relevant when updating a resource. So it may
            feel like I am repeating myself, but its because I am it is important. :)
        </p>
        <p>
            So, firstly, when ever a resource is touched in the database its we need to specify which fields are mass
            assignable by adding them to the <code class="myCode">fillable</code> attribute on the model. More
            information about mass assignment can be found in Laravel's
            <a class="text-blue-500" target="_blank" href="https://laravel.com/docs/master/eloquent#mass-assignment">
                Mass Assignment</a> Documentation;
        </p>
        <p>
            Also, the Entity inherently requires some relationships to be useful at the end of the day and have been
            outlined in the model below as well. See <code class="myCode">public function users()</code> which
            defines the relationship
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.entity.show/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally, after a resource is updated, the controller will return to a view to essentially show
            the updated resource or to which ever page the user previously navigated from, for example a profile page.
        </p>
        <p>
            Based on the controller's return statement the
            <code class="myCode">/resources/views/actions/entity/update.blade.php</code> view will render the HTML
            of this page you are currently viewing. The <code class="myCode">$entity</code> object will also be
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

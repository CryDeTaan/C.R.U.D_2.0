@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.R.U.Destroy {{ slug_to_title(request()->actionOn) }}</div>

        <p>
            The <code class="myCode">D</code> in C.R.U.D. is for Destroying a resources. To destroy a resource a form is
            sent to <code class="myCode">{{ request()->url() }}</code> URL using <code class="myCode">DELETE</code>
            method.
        </p>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            Similar to the update action spoofing the <code class="myCode">PUT</code> form methods, so does the destroy
            action spoof the <code class="myCode">DELETE</code> form method using <code
                class="myCode">&#64;method</code> Blade directive. This creates a hidden input field for the form:<br>
            <code class="myCode">&lt;input name="_method" value="DELETE"&gt;</code>
        </p>
        <p>
            The action on the form <code class="myCode">action="/resources/{id}"</code> will essential trigger the
            process of destroying the resource with the following route definition in the
            <code class="myCode">routes/web.php</code> file:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="resources/{id}"
                        controller="Resources"
                        action="delete"
                        method="destroy"
                    ></x-route></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">delete_resource</code>
            Ability and is authorised by the <code class="myCode">delete</code> Policy method as follow:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.resource.generic
                        className="Resource"
                        modelIncluded="resource"
                        message="delete the model"
                        method="delete"
                        secondCheck="true"
                        ability="delete_resource"
                    /></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">destroy</code> method in the
            <code class="myCode">{{ slug_to_controller(request()->actionOn) }}Controller</code> obtains the instance
            through Route Model Binding, and then simply calls the destroy() method after which the view, most probably
            to the list of {{ slug_to_title(request()->actionOn) }}s.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.resource.destroy/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Generally there isn't a 'dedicate' view for when a resource is deleted. A user will most probably be
            redirected to the <a class="text-blue-500" href="{{ url()->previous() }}">previous</a> page.
        </p>

        {{-- Note Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Note</div>
        <p>
            As far as deleting a resource goes, that's about it, there are times where I may want to cascade
            onDelete, in other words delete any foreign key constraints associated with the record.
        </p>
        <p>
            For the purposes of this demo app, I will not make use of this at this time.
        </p>

        <script>
            openSidebarItem("{{ request()->actionOn }}");
        </script>
@endsection

@extends('main')

@section('body')
    <div>
        <!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
        <div class="text-2xl mb-6 mt-4">
            C.Read.U.D {{ slug_to_title(request()->actionOn) }}</div>

        <p>
            The <code class="myCode">R</code> in C.R.U.D. is for Reading resources. In my mind at least there are two
            options when it comes to reading a resource, 1. reading all resources and, 2. reading a single resource.
            In this page I am listing all the resource of the specific type, and selecting a resource from below will
            take us to a specific resource.
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
        <x-users-table :users="$users"></x-users-table>

        {{-- Route Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            Most of the actions on a user can be performed in then UsersController, it sometimes helps to break this out
            when specific logic is required. So at this point I thought it's a good idea to do just that.
        </p>
        <p>
            To receive a view containing a list of {{ slug_to_title(request()->actionOn) }}s the
            <code class="myCode">{{ request()->url() }}</code> URL was requested using the
            <code class="myCode">{{ request()->method() }}</code> method, therefor the defined route for this request in
            <code class="myCode">routes/web.php</code> is as follow:
        </p>

        {{-- Route Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs"><x-route
                        uri="users"
                        controller="User"
                        action="get"
                        method="index"
                    ></x-route></code></pre>
        </div>

        {{-- Policy Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Policy</div>
        <p>
            To perform this action the authenticated user should have the <code class="myCode">read</code> Ability and
            is authorised by the <code class="myCode">viewAny</code> Policy method as follow:
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.user.generic
                        message="view any models"
                        method="viewAny"
                        action="read"
                    /></code></pre>
        </div>

        {{-- Controller Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The <code class="myCode">index</code> method in the
            <code class="myCode">{{ slug_to_controller(request()->actionOn) }}Controller</code>
            will handel this request. And although the resources in this request are still of type User, I want to
            control which user resources are returned, and in this case I only want to return
            {{ slug_to_title(request()->actionOn) }}s. Now, because of this, I need to include the App\Role class and
            not App\User like for the other actions.
        </p>
        <p>
            Even tough I created the <code class="myCode">$user</code> object in two steps, this can totally be done in
            a single line, I could have
            inline'd it in the return statement, but the way I did it provides some clarity on what is happening.
        </p>

        {{-- Controller Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.user.index
                        role="{{ request()->actionOn }}"></x-controllers.user.index></code></pre>
        </div>

        {{-- Model Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            In order to return the Users associated with a give role, the model has to be configured with a
            <code class="myCode">belongsToMany()</code> relationship. This is what allows me to access the users of a
            given role.
        </p>

        {{-- Model Code Block --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php"><x-models.user.index/></code></pre>
        </div>

        {{-- View Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            Based on the controller's return statement(<code class="myCode">return view('actions.users.read',
                compact('users'));</code>) the <code class="myCode">/resources/views/actions/users/read.blade.php</code>
            view will render the HTML of this page.
        </p>
        <p>
            The <code class="myCode">$users</code> object will contain only the users with the
            {{ request()->actionOn }} role and can be seen below. This object is also used to "build" the table
            at the start of the page using the Laravel Blade Control Structure;
            <code class="myCode">&#64;foreach ($users as $user)</code>
        </p>

        {{-- Resource json payload --}}
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">{{ @json_encode($users, JSON_PRETTY_PRINT) }}</code></pre>
        </div>
    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");
    </script>
@endsection

@extends('main')

@section('body')
    <div>
        <div class="text-2xl mb-8 mt-4">C.R.U.D - Roles Model</div>
        <p>
            There are two <code class="myCode">Many-to-Many</code> relationships for the Role model:
        </p>
        <ol class="list-decimal mb-4 text-xs pl-10">
            <li>
                Role -> <a class="text-blue-500" href="{{ url()->previous() }}">User</a>
            </li>
            <li>
                Role -> <a class="text-blue-500" href="/abilities">Abilities</a>
            </li>
        </ol>
        <p>
            These <code class="myCode">Many-to-Many</code> relationship are defined below. Also take note of the
            <code class="myCode">allowTo($ability)</code> function, which shows the process of adding an ability to a
            Role
        </p>

        {{-- Abilities Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-models.roles/></code></pre>
        </div>

    </div>
@endsection

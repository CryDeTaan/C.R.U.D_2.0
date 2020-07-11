@extends('main')

@section('body')
    <div>
        <div class="text-2xl mb-8 mt-4">C.R.U.D - get_role() Helper</div>
        <p>
            This is just a simple helper I make use of to obtain an instance of a $role based on the given name.
        </p>

        {{-- Helper Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php">&lt;?php

if (!function_exists('get_role')) {

    function get_role($role)
    {
        return App\Role::whereName($role)->first();
    }
}</code></pre>
        </div>

    </div>
@endsection

@extends('main')

@section('body')
    <div>
        <div class="text-2xl mb-8 mt-4">C.R.U.D - Abilities Model</div>
        <p>
            The <code class="myCode">Many-to-Many</code> relationship between Abilities and
            <a class="text-blue-500" href="/roles">Roles</a> is defined below.
        </p>

        {{-- Abilities Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-models.abilities/></code></pre>
        </div>

    </div>
@endsection

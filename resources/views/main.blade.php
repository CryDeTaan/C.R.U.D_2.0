@extends('layouts.app')

@section('content')

    <div class="flex">
        <div class="h-screen sticky top-0 overflow-y-auto pl-64 pr-12 bg-gray-700 text-gray-200">
            {{-- Fixed Side Bar --}}
            <x-sidebar/>
        </div>

        <div class="px-16 mb-10 w-2/4">
            {{-- Body --}}
            @yield('body')
        </div>

    </div>
@endsection

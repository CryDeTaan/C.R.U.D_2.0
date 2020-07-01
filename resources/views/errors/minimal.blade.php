@extends('main')

@section('body')

    <div class="flex h-screen">
        <div class="m-auto">
            <div>
                @yield('code')
            </div>
            <div>
                @yield('message')
            </div>
        </div>
    </div>

    <script>
        openSidebarItem("{{ request()->actionOn }}");
    </script>
    
@endsection

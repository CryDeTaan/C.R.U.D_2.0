@extends('main')

@section('body')

    {{-- Be carefull here, the x-crud.read componet is not escaping this message for he code class fo work. --}}
    <p>
        Please be sure to impersonate a user by selecting an 'Impersonations' option from the sidebar to the left.
        This will simulate an authentication attempt and the authenticated user's information will display below.
    </p>

@endsection

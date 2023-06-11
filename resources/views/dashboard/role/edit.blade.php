@extends('dashboard.layout')

@section('content')
    <h1>Update Role: {{ $role->title }}</h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('role.update',$role->id) }}" method="post">
        @method("PATCH")
        @include('dashboard.role._form')
    </form>
@endsection

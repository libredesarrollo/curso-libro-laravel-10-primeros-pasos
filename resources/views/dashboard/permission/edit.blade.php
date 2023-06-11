@extends('dashboard.layout')

@section('content')
    <h1>Update Permission: {{ $permission->title }}</h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('permission.update',$permission->id) }}" method="post">
        @method("PATCH")
        @include('dashboard.permission._form')
    </form>
@endsection

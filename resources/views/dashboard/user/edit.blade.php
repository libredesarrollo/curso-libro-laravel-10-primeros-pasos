@extends('dashboard.layout')

@section('content')
    <h1>Update User: {{ $user->name }}</h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('user.update',$user->id) }}" method="post">
        @method("PATCH")
        @include('dashboard.user._form')
    </form>
@endsection

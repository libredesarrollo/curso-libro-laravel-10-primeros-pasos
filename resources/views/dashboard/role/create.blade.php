@extends('dashboard.layout')

@section('content')
    <h1>Create role</h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('role.store') }}" method="post">

        @include('dashboard.role._form')

    </form>
@endsection

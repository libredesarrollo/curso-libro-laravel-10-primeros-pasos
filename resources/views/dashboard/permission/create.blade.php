@extends('dashboard.layout')

@section('content')
    <h1>Create permission</h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('permission.store') }}" method="post">

        @include('dashboard.permission._form')

    </form>
@endsection

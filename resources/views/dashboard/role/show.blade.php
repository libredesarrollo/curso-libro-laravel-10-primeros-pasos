@extends('dashboard.layout')

@section('content')
    <h1>{{ $role->name }}</h1>
    <x-dashboard.role.permission.manage :role="$role"/>
@endsection

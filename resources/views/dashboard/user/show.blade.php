@extends('dashboard.layout')

@section('content')
    <h1>{{ $user->name }}</h1>
    <ul>
        <li>{{ $user->email }}</li>
    </ul>

    @can('editor.user.update')
        <x-dashboard.user.role.permission.manage :user="$user" />
    @endcan

@endsection

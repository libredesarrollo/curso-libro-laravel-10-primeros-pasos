@extends('dashboard.layout')

@section('content')

    <a class="my-2 btn btn-success" href="{{ route("role.create") }}">Create</a>

    <table class="table mb-3">
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($roles as $r)
                <tr>
                    <td>
                        {{ $r->name }}
                    </td>
                    <td>
                        <a class="btn btn-primary mt-2" href="{{ route("role.edit", $r) }}">Edit</a>
                        <a class="btn btn-primary mt-2" href="{{ route("role.show", $r) }}">Show</a>

                        <form action="{{ route("role.destroy", $r) }}" method="post">
                            @method("DELETE")
                            @csrf
                            <button class="btn btn-danger mt-2" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $roles->links() }}

@endsection

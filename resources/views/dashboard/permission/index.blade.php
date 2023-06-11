@extends('dashboard.layout')

@section('content')

    <a class="my-2 btn btn-success" href="{{ route("permission.create") }}">Create</a>

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
            @foreach ($permissions as $p)
                <tr>
                    <td>
                        {{ $p->name }}
                    </td>
                    <td>
                        <a class="btn btn-primary mt-2" href="{{ route("permission.edit", $p) }}">Edit</a>
                        <a class="btn btn-primary mt-2" href="{{ route("permission.show", $p) }}">Show</a>

                        <form action="{{ route("permission.destroy", $p) }}" method="post">
                            @method("DELETE")
                            @csrf
                            <button class="btn btn-danger mt-2" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $permissions->links() }}

@endsection

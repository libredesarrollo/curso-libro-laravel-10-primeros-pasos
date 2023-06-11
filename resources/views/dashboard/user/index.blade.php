@extends('dashboard.layout')

@section('content')
    @can('editor.user.create')
        <a class="my-2 btn btn-success" href="{{ route('user.create') }}">Create</a>
    @endcan
    <table class="table mb-3">
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $u)
                <tr>

                    <td>
                        {{ $u->name }}
                    </td>
                    <td>
                        {{ $u->email }}
                    </td>
                    <td>
                        @can('editor.user.update')
                            <a class="btn btn-primary mt-2" href="{{ route('user.edit', $u) }}">Edit</a>
                        @endcan
                        <a class="btn btn-primary mt-2" href="{{ route('user.show', $u) }}">Show</a>

                        @can('editor.user.destroy')
                            <form action="{{ route('user.destroy', $u) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger mt-2" type="submit">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $users->links() }}
@endsection

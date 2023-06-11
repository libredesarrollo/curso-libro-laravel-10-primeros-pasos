@extends('dashboard.layout')

@section('content')
    @can('editor.category.create')
        <a class="my-2 btn btn-success" href="{{ route('category.create') }}">Crear</a>
    @endcan
    <table class="table mb-3">
        <thead>
            <tr>
                <th>
                    Titulo
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categories as $c)
                <tr>
                    <td>
                        {{ $c->title }}
                    </td>
                    <td>
                        @can('editor.category.update')
                            <a class="btn btn-primary mt-2" href="{{ route('category.edit', $c) }}">Editar</a>
                        @endcan
                        <a class="btn btn-primary mt-2" href="{{ route('category.show', $c) }}">Ver</a>

                        @can('editor.category.destroy')
                            <form action="{{ route('category.destroy', $c) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger mt-2" type="submit">Eliminar</button>
                            </form>
                        @endcan

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $categories->links() }}
@endsection

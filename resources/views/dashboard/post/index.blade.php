@extends('dashboard.layout')

@section('content')
    @can('editor.post.create')
        <a class="btn btn-success my-3" href="{{ route('post.create') }}">Crear</a>
    @endcan
    <table class="table mb-3">
        <thead>
            <tr>
                <th>
                    Titulo
                </th>
                <th>
                    Categoria
                </th>
                <th>
                    Posted
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($posts as $p)
                <tr>
                    <td>
                        {{ $p->title }}
                    </td>
                    <td>
                        {{ $p->category->title }}
                    </td>
                    <td>
                        {{ $p->posted }}
                    </td>
                    <td>
                        @can('editor.post.update')
                            <a class="mt-2 btn btn-primary" href="{{ route('post.edit', $p) }}">Editar</a>
                        @endcan
                        <a class="mt-2 btn btn-primary" href="{{ route('post.show', $p) }}">Ver</a>

                        @can('editor.post.destroy')
                            <form action="{{ route('post.destroy', $p) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="mt-2 btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        @endcan

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $posts->links() }}
@endsection

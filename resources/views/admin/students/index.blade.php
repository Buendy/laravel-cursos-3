@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', [
'title' => __('app.subscriptions.admin'),
'icon' => __('list-ol')
])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justifiy-content-around">
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th >#</th>

                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Acciones</th>

                </tr>
                </thead>
                <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->student->title }}</td>
                        <td>{{ $student->email }}</td>

                        <td class="text-center">
                            <a href="{{url('/manage/students/'. $student->id .'/edit/')}}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ url('/manage/students/'. $student->id . '/destroy')}}" method="post" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr colspan="8">No hay estudiantes</tr>
                @endforelse
                </tbody>
            </table>
            {{ $students->links() }}
        </div>
    </div>
@endsection

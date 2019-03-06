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
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Nivel</th>
                    <th>Profesor</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($courses as $course)
                    <tr>
                        <th>{{$course->name}}</th>
                        <th>{{$course->category->name}}</th>
                        <th>{{$course->level->name}}</th>
                        <th>{{$course->teacher->user->name}}</th>

                        @if($course->status == '1')
                            <th class="text-success text-center">Publicado</th>
                            <th>
                                <a href="{{ route('admin.courses.edit', ['slug' => $course->slug]) }}" class="btn btn-warning btn-sm">Editar</a>
                                <a href="{{ route('admin.courses.cancel', ['slug' => $course->slug]) }}" class="btn btn-danger btn-sm">Cancelar curso</a>
                            </th>
                        @elseif($course->status == '2')
                            <th class="text-warning text-center">Pendiente</th>
                            <th>
                                <p><a href="{{ route('admin.courses.edit', ['slug' => $course->slug]) }}" class="btn btn-warning btn-sm">Editar</a>
                                <a href="{{ route('admin.courses.publish', ['slug' => $course->slug]) }}" class="btn btn-success btn-sm">Publicar</a>
                                <a href="{{ route('admin.courses.cancel', ['slug' => $course->slug]) }}" class="btn btn-danger btn-sm">Cancelar curso</a></p>
                            </th>
                        @else
                            <th class="text-danger text-center">Cancelado</th>
                            <th>
                                <a href="{{ route('admin.courses.edit', ['slug' => $course->slug]) }}" class="btn btn-warning btn-sm">Editar</a>
                                <a href="{{ route('admin.courses.activate', ['slug' => $course->slug]) }}" class="btn btn-primary btn-sm">Activar curso</a>
                            </th>
                        @endif

                    </tr>

                @empty
                    <tr colspan="8">No hay cursos</tr>
                @endforelse
                </tbody>
            </table>
            {{ $courses->links() }}
        </div>
    </div>
@endsection

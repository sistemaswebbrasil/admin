@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Usuários</h1>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('usuario.create') }}"> Create New usuario</a>
            </div>
@stop

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th width="280px">Ação</th>
        </tr>
    @foreach ($usuarios as $key => $usuario)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $usuario->name }}</td>
        <td>{{ $usuario->email }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('usuario.show',$usuario->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('usuario.edit',$usuario->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['usuario.destroy', $usuario->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $usuarios->render() !!}

@endsection
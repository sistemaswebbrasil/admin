@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Funções</h1>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('role.create') }}"> Criar nova Função</a>
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
            <th>Apelido</th>
            <th width="280px">Ação</th>
        </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ $role->id }}</td>
        <td>{{ $role->name }}</td>
        <td>{{ $role->display_name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('role.show',$role->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('role.edit',$role->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['role.destroy', $role->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $roles->render() !!}
@endsection
@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Permissões</h1>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('permission.create') }}"> Criar nova Função</a>
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
    @foreach ($permissions as $key => $permission)
    <tr>
        <td>{{ $permission->id }}</td>
        <td>{{ $permission->name }}</td>
        <td>{{ $permission->display_name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('permission.show',$permission->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('permission.edit',$permission->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['permission.destroy', $permission->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $permissions->render() !!}
@endsection
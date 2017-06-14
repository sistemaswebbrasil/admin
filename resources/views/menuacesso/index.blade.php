@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Menu de Acesso</h1>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('menuacesso.create') }}"> Criar nova Função</a>
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
            <th>Título</th>
            <th>URL</th>
            <th width="280px">Ação</th>
        </tr>
    @foreach ($menuacessos as $key => $menuacesso)
    <tr>
        <td>{{ $menuacesso->id }}</td>
        <td>{{ $menuacesso->text }}</td>
        <td>{{ $menuacesso->url }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('menuacesso.show',$menuacesso->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('menuacesso.edit',$menuacesso->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['menuacesso.destroy', $menuacesso->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $menuacessos->render() !!}
@endsection
@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content_header')
<h1>Editar novo usuário</h1>
<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('usuario.index') }}"> Back</a>
</div>
@stop

@section('content')



@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Atenção!</strong>Foram encontrados os seguintes dados incorretos:<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- {!! Form::model($usuario, ['method' => 'PATCH','route' => ['usuario.update', $usuario->id]]) !!} -->

{!! Form::model($usuario, ['method' => 'PATCH', 'route' =>  ['usuario.update', $usuario->id], 'files' => true]) !!}    




<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}">
            <input type="password" name="new_password" class="form-control"
            placeholder="{{ trans('adminlte::adminlte.password') }}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('new_password'))
            <span class="help-block">
                <strong>{{ $errors->first('new_password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <input type="password" name="password_confirmation" class="form-control"
            placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>    
    </div> 


    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group" >                
            <img src={{ $usuario->avatar }} id='avatar' width="200px" > 
<!--             @if (!empty($usuario->avatar))
                
            @else
                <img src='/usuarios/usuario.jpg' id='avatar' width="200px" > 
                @endif -->
            </div>
        </div>        

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Carregar Avatar</strong>            
                {!! Form::file('avatar', ['class' => 'form-control border-input','id' => 'avatar-input']) !!}


            </div>
        </div> 


        <hr>

        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
        @section('js')

        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                //$('#profile-img-tag').attr('src', e.target.result);
                $('#avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#avatar-input").change(function(){
        readURL(this);
    });
</script>
@stop










<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Confirmar</button>
</div>

</div>
{!! Form::close() !!}

@endsection
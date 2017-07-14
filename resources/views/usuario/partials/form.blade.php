<div class="box-body">

<!-- <div class="box-header">
    <a class="btn btn-primary" href="{{ route('usuario.index') }}"><i class="fa fa-chevron-left"> {{ trans('geral.voltar') }}</i> </a>
    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check-circle"> {{ trans('geral.confirmar') }}</i></button>
</div> -->



  <!-- Nav tabs -->
<div class="nav-tabs-custom">  
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#geral" aria-controls="geral" role="tab" data-toggle="tab">{{ trans('geral.geral')}}</a></li>
    <li role="presentation"><a href="#avatar" aria-controls="avatar" role="tab" data-toggle="tab">{{ trans('usuario.avatar')}}</a></li>
    @if (Route::current()->getName() != 'usuario.profile'  )  
        <li role="presentation"><a href="#roles" aria-controls="roles" role="tab" data-toggle="tab">    
        {{ trans('usuario.roles')}}</a></li>
    @endif
    <li role="presentation"><a href="#preferencias" aria-controls="preferencias" role="tab" data-toggle="tab">  {{ trans('geral.preferencias')}}</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="geral">



    <div class="form-group">
        <strong>{{ trans('usuario.name') }}:</strong>
        {!! Form::text('name', null, array('placeholder' => trans('usuario.name'),'class' => 'form-control')) !!}
    </div>
    

    
    <div class="form-group">
        <strong>{{ trans('usuario.email') }}:</strong>
        {!! Form::text('email', null, array('placeholder' => trans('usuario.email'),'class' => 'form-control')) !!}
    </div>







<div class="form-group">
    @if(isset($usuario))
    <strong>{{ trans('usuario.trocarsenha') }}:</strong>        
    <div class="form-group has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}">
        <input type="password" name="new_password" class="form-control"
        placeholder="{{ trans('usuario.trocarsenha') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('new_password'))
        <span class="help-block">
            <strong>{{ $errors->first('new_password') }}</strong>
        </span>
        @endif
    </div>
    @else
    <strong>{{ trans('adminlte::adminlte.password') }}:</strong>        
    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
        <input type="password" name="password" class="form-control"
        placeholder="{{ trans('adminlte::adminlte.password') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
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
    <div role="tabpanel" class="tab-pane" id="avatar">
        <div class="form-group" >                

            @if (!empty($usuario->avatar))
            <img src={{ $usuario->avatar }} id='avatar' width="200px" > 

            @else
            <img src='/usuarios/usuario.jpg' id='avatar' width="200px" > 
            @endif
        </div>
               


        <div class="form-group">
            <strong>{{ trans('usuario.avatar') }}</strong>            
            {!! Form::file('avatar', ['class' => '','id' => 'avatar-input']) !!}

        </div>        

    </div>

    @if (Route::current()->getName() != 'usuario.profile'  )  
    <div role="tabpanel" class="tab-pane" id="roles">
        <div class="form-group">
            <strong>{{ trans('usuario.roles') }}:</strong>
            {!! Form::select('roles[]',$roles,null,['class' => 'form-control', 
            'multiple' => 'multiple']) !!}
        </div>        
    </div>
    @endif
    

    <div role="tabpanel" class="tab-pane" id="preferencias">
        <div class="form-group">
            <select class="form-control" name="language">
                @foreach($languages as $language)
                <option value="{{$language}}"   
                @if(isset($usuario))
                    {{ $usuario->language == $language ? 'selected="selected"' : '' }} 
                @endif> 
                {{ trans(  'usuario.'.$language ) }}
                </option>                  
                @endforeach
            </select>    
        </div> 

        <div class="form-group">
            <select class="form-control" name="skin">
                @foreach($skins as $skin)
                <option value="{{$skin}}"   
                @if(isset($usuario))
                    {{ $usuario->skin == $skin ? 'selected="selected"' : '' }} 
                @endif> 
                {{ $skin }}
                </option>                  
                @endforeach
            </select>              
        </div>


    </div>
  </div>
</div>  


   










</div>




<div class="box-footer">
    <a class="btn btn-primary" href="{{ route('usuario.index') }}"><i class="fa fa-chevron-left"> {{ trans('geral.voltar') }}</i> </a>
    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check-circle"> {{ trans('geral.confirmar') }}</i></button>
</div>





</div>
</div>
</div>

@section('js')

<script type="text/javascript">

    function readURL(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();
            
            reader.onload = function (e) {
                //$('#profile-img-tag').attr('src', e.target.result);
                //
                
                //alert( e.target.result);
                
                console.log(e.target.result);
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
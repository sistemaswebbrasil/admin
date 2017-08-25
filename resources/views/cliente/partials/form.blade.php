<div class="box-body">


@if (count($errors) > 0)

<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> {{ trans('geral.errovalidacao') }} </h4>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
</div>



@endif

  <!-- Nav tabs -->
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#geral" aria-controls="geral" role="tab" data-toggle="tab">{{ trans('geral.geral')}}</a></li>
    <li role="presentation"><a href="#avatar" aria-controls="avatar" role="tab" data-toggle="tab">{{ trans('cliente.avatar')}}</a></li>
    @if (Route::current()->getName() != 'cliente.profile'  )
        <li role="presentation"><a href="#roles" aria-controls="roles" role="tab" data-toggle="tab">
        {{ trans('cliente.roles')}}</a></li>
    @endif
    <li role="presentation"><a href="#preferencias" aria-controls="preferencias" role="tab" data-toggle="tab">  {{ trans('geral.preferencias')}}</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="geral">


<div class="form-group">


<div class="row">
  <div class="col-xs-3 has-feedback {{ $errors->has('cl_codigo') ? 'has-error' : '' }} has-feedback {{ $errors->has('cl_codigo') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_codigo') }}:</strong>
    {!! Form::text('cl_codigo', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>

  <div class="col-xs-3 has-feedback {{ $errors->has('cl_pessoa') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_pessoa') }}:</strong>
    {!! Form::select('cl_pessoa',$tipopessoas,null,['class' => 'form-control']) !!}
  </div>


  <div class="col-xs-3 has-feedback {{ $errors->has('cl_cpf') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_cpf') }}:</strong>
    {!! Form::text('cl_cpf', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control cpfcnpj')) !!}
  </div>

  <div class="col-xs-3 has-feedback {{ $errors->has('cl_rgie') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_rgie') }}:</strong>
    {!! Form::text('cl_rgie', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>


</div>


</div>



<div class="form-group">
<div class="row">

  <div class="col-xs-3 has-feedback {{ $errors->has('cl_nome') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_nome') }}:</strong>
    {!! Form::text('cl_nome', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>


  <div class="col-xs-3 has-feedback {{ $errors->has('cl_conjuge') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_conjuge') }}:</strong>
    {!! Form::text('cl_conjuge', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>


</div>


</div>



<div class="form-group">
<div class="row">
  <div class="col-xs-3 has-feedback {{ $errors->has('cl_fone') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_fone') }}:</strong>
    {!! Form::text('cl_fone', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control  telefone')) !!}
  </div>


  <div class="col-xs-3 has-feedback {{ $errors->has('cl_celular') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_celular') }}:</strong>
    {!! Form::text('cl_celular', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control telefone ')) !!}
  </div>


  <div class="col-xs-3 has-feedback {{ $errors->has('cl_email') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_email') }}:</strong>
    {!! Form::text('cl_email', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>


  <div class="col-xs-3 has-feedback {{ $errors->has('cl_nascimento') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_nascimento') }}:</strong>
    {!! Form::text('cl_nascimento', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control data')) !!}
  </div>


</div>


</div>



<div class="form-group">
<div class="row">
  <div class="col-xs-3 has-feedback {{ $errors->has('cl_cep') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_cep') }}:</strong>
    {!! Form::text('cl_cep', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control cep')) !!}
  </div>


  <div class="col-xs-3 has-feedback {{ $errors->has('cl_endereco') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_endereco') }}:</strong>
    {!! Form::text('cl_endereco', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>


  <div class="col-xs-3 has-feedback {{ $errors->has('cl_numero') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_numero') }}:</strong>
    {!! Form::text('cl_numero', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>


  <div class="col-xs-3 has-feedback {{ $errors->has('cl_complemento') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_complemento') }}:</strong>
    {!! Form::text('cl_complemento', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>


</div>


</div>



<div class="form-group">
<div class="row">
  <div class="col-xs-3 has-feedback {{ $errors->has('cl_bairro') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_bairro') }}:</strong>
    {!! Form::text('cl_bairro', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>

  <div class="col-xs-3 has-feedback {{ $errors->has('cl_cidade') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_cidade') }}:</strong>
    {!! Form::text('cl_cidade', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>

  <div class="col-xs-3 has-feedback {{ $errors->has('cl_uf') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_uf') }}:</strong>
    {!! Form::text('cl_uf', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>

  <div class="col-xs-3 has-feedback {{ $errors->has('cl_cidade') ? 'has-error' : '' }}">
  <strong>{{ trans('validation.attributes.cl_cidade') }}:</strong>
    {!! Form::text('cl_cidade', null, array('placeholder' => trans('geral.codigo'),'class' => 'form-control')) !!}
  </div>

</div>

</div>






    </div>

    <div role="tabpanel" class="tab-pane" id="avatar">
        <div class="form-group" >

            @if (!empty($cliente->avatar))
            <img src={{ $cliente->avatar }} id='avatar' width="200px" >

            @else
            <img src='/clientes/cliente.jpg' id='avatar' width="200px" >
            @endif
        </div>




        <div class="form-group">
            <strong>{{ trans('cliente.avatar') }}</strong>
            {!! Form::file('avatar', ['class' => '','id' => 'avatar-input']) !!}

        </div>


    </div>





    <div role="tabpanel" class="tab-pane" id="preferencias">





    </div>

  </div>

</div>














</div>





<div class="box-footer">
    <a class="btn btn-primary" href="{{ route('cliente.index') }}"><i class="fa fa-chevron-left"> {{ trans('geral.voltar') }}</i> </a>
    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check-circle"> {{ trans('geral.confirmar') }}</i></button>
</div>






</div>

</div>

</div>


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.3/jquery.mask.min.js"></script>
<script type="text/javascript">


$(document).ready(function(){



var SPMaskBehavior = function (val) {
    var masks = ['0000-00009', '0 0000-00009','(00)0000-00009','(00) 0 0000-0000'];
    if (val.replace(/\D/g, '').length === 9){
        mask = masks[1];
    }else if (val.replace(/\D/g, '').length === 10){
        mask = masks[2];
    }else if (val.replace(/\D/g, '').length === 11){
        mask = masks[3];
    }else if (val.replace(/\D/g, '').length === 8){
        mask = masks[0];
    }
  return mask;//val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$('.telefone').mask(SPMaskBehavior, spOptions);

var options = {onKeyPress: function(cpf, e, f, options){
var masks = ['000.000.000-009', '00.000.000/0000-00'];
mask = (cpf.length>14) ? masks[1] : masks[0];
$('.cpfcnpj').mask(mask, options);
}};

$('.cpfcnpj').mask('000.000.000-009', options);

$('.cep').mask('00000-000');
$('.data').mask('00/00/0000');

});

</script>
@stop

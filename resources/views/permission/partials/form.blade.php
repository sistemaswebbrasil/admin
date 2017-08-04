<div class="box-body">
    @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
        <button aria-hidden="true" class="close" data-dismiss="alert" type="button">
            ×
        </button>
        <h4>
            <i class="icon fa fa-ban">
            </i>
            {{ trans('geral.errovalidacao') }}
        </h4>
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- Nav tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" permission="tablist">
            <li class="active" permission="presentation">
                <a aria-controls="geral" data-toggle="tab" href="#geral" permission="tab">
                    {{ trans('geral.geral')}}
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="geral" permission="tabpanel">
                <div class="form-group">
                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                        <strong>
                            {{ trans('geral.name') }}:
                        </strong>
                        {!! Form::text('name', null, array('placeholder' => trans('geral.name'),'class' => 'form-control')) !!}

                        </span>
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('name') }}
                            </strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group has-feedback {{ $errors->has('display_name') ? 'has-error' : '' }}">
                        <strong>
                            {{ trans('geral.display_name') }}:
                        </strong>
                        {!! Form::text('display_name', null, array('placeholder' => trans('geral.display_name'),'class' => 'form-control')) !!}

                        </span>
                        @if ($errors->has('display_name'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('display_name') }}
                            </strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group has-feedback {{ $errors->has('description') ? 'has-error' : '' }}">
                        <strong>
                            {{ trans('geral.description') }}:
                        </strong>
                        {!! Form::textarea('description', null, array('placeholder' => trans('geral.description'),'class' => 'form-control')) !!}

                        </span>
                        @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('description') }}
                            </strong>
                        </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="box-footer">
    <a class="btn btn-primary" href="{{ route('usuario.index') }}">
        <i class="fa fa-chevron-left">
            {{ trans('geral.voltar') }}
        </i>
    </a>
    <button class="btn btn-primary pull-right" type="submit">
        <i class="fa fa-check-circle">
            {{ trans('geral.confirmar') }}
        </i>
    </button>
</div>

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
            <div class="form-group has-feedback {{ $errors->has('text') ? 'has-error' : '' }}">
                <strong>{{ trans('geral.titulo') }}:</strong>
                {!! Form::text('text', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                        @if ($errors->has('text'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('text') }}
                            </strong>
                        </span>
                        @endif
            </div>
        </div>

        <div class="form-group">
            <div class="form-group has-feedback {{ $errors->has('url') ? 'has-error' : '' }}">
                <strong>{{ trans('geral.url') }}:</strong>
                {!! Form::text('url', null, array('placeholder' => 'Apelido','class' => 'form-control')) !!}
                        @if ($errors->has('url'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('url') }}
                            </strong>
                        </span>
                        @endif
            </div>
        </div>

        <div class="form-group">
            <div class="form-group has-feedback {{ $errors->has('parent') ? 'has-error' : '' }}">
                <strong>{{ trans('geral.parent') }}:</strong>
                {!! Form::select('parent',$menus,null,['class' => 'form-control','placeholder' =>  trans('geral.selecione') ]) !!}
                        @if ($errors->has('parent'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('parent') }}
                            </strong>
                        </span>
                        @endif
            </div>
        </div>

        <div class="form-group">
            <div class="form-group has-feedback {{ $errors->has('icon') ? 'has-error' : '' }}">
                <strong>{{ trans('geral.icon') }}:</strong>
             <select class="form-control" name="icon">
                <option value="">{{trans('geral.selecione')}}</option>
                @foreach($icones as $item)
                  <option value="{{$item}}"   {{ $menuacesso->icon == $item ? 'selected="selected"' : '' }} >{{$item}}</option>
                @endforeach
              </select>
                        @if ($errors->has('icon'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('icon') }}
                            </strong>
                        </span>
                        @endif
            </div>
        </div>


        <div class="form-group">
            <div class="form-group has-feedback {{ $errors->has('icon_color') ? 'has-error' : '' }}">
                <strong>{{ trans('geral.icon_color') }}:</strong>
                {!! Form::select('icon_color',$iconesCores,null,['class' => 'form-control','placeholder' =>  trans('geral.selecione') ]) !!}
                        @if ($errors->has('icon_color'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('icon_color') }}
                            </strong>
                        </span>
                        @endif
            </div>
        </div>

        <div class="form-group">
            <div class="form-group has-feedback {{ $errors->has('label') ? 'has-error' : '' }}">
                <strong>{{ trans('geral.label') }}:</strong>
                    {!! Form::text('label', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('label'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('label') }}
                            </strong>
                        </span>
                        @endif
            </div>
        </div>


        <div class="form-group">
            <div class="form-group has-feedback {{ $errors->has('label_color') ? 'has-error' : '' }}">
                <strong>{{ trans('geral.label_color') }}:</strong>
             <select class="form-control" name="label_color">
                <option value="">{{ trans('geral.selecione') }}</option>
                @foreach($label_colors as $item)
                  <option value="{{$item}}"

                        {{ $menuacesso->label_colors == $item ? 'selected="selected"' : '' }} >{{$item}}
                   </option>
                @endforeach
              </select>
                @if ($errors->has('label_color'))
                <span class="help-block">
                    <strong>
                        {{ $errors->first('label_color') }}
                    </strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="form-group has-feedback {{ $errors->has('target') ? 'has-error' : '' }}">
                <strong>{{ trans('geral.target') }}:</strong>
                {!! Form::select('target',$targets,null,['class' => 'form-control','placeholder' => trans('geral.selecione')]) !!}
                        @if ($errors->has('target'))
                        <span class="help-block">
                            <strong>
                                {{ $errors->first('target') }}
                            </strong>
                        </span>
                        @endif
            </div>
        </div>






        <div class="form-group">
            <div class="form-group has-feedback {{ $errors->has('permission') ? 'has-error' : '' }}">
                <strong>{{ trans('geral.permission') }}:</strong>
             <select class="form-control" name="permission">
                <option value="">{{ trans('geral.selecione') }}</option>
                @foreach($permissions as $item)
                  <option value="{{$item->id}}"

                    {{ $menuacesso->permission == $item->id ? 'selected="selected"' : '' }} >{{$item->display_name}}
                   </option>
                @endforeach
              </select>
                @if ($errors->has('permission'))
                <span class="help-block">
                    <strong>
                        {{ $errors->first('permission') }}
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

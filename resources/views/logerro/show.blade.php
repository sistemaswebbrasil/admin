<div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
            <h3 class="profile-username text-center">{{ $logerro->cl_codigo }}</h3>
            <p class="text-muted text-center">{{ $logerro->cl_nome }}</p>

        </div>

    </div>
</div>
<div class="col-md-9">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('geral.detalhes') }}</h3>
  </div>
  <div class="box-body">
      <strong><i class="fa fa-book margin-r-5"></i> {{ trans('geral.usuario') }}</strong>
      <p class="text-muted">
        {{ $logerro->usuario }}
    </p>
    <hr>
    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('geral.estacao') }}</strong>
      <p class="text-muted">
        {{ $logerro->estacao }}
    </p>
    <hr>
    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('geral.loja') }}</strong>
      <p class="text-muted">
        {{ $logerro->loja }}
    </p>
    <hr>

    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('geral.ip') }}</strong>
      <p class="text-muted">
        {{ $logerro->ip }}
    </p>
    <hr>

    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('geral.sistema') }}</strong>
      <p class="text-muted">
        {{ $logerro->sistema }}
    </p>
    <hr>

    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('geral.sql_rowid') }}</strong>
      <p class="text-muted">
        {{ $logerro->sql_rowid }}
    </p>
    <hr>

    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('geral.lido') }}</strong>
      <p class="text-muted">
        {{ $logerro->lido }}
    </p>
    <hr>

    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('geral.erro') }}</strong>
      <p class="text-muted">
        {{ $logerro->erro }}
    </p>
    <hr>

    <div class="row">
      <div class="col-md-6">
        <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('geral.data') }}</strong>
        </p>
        @if (!empty($logerro->data))
          {{ $logerro->data->diffForHumans() }}
        @endif
        </p>
    </div>
    <div class="col-md-6">
      <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('geral.hora') }}</strong>
      </p>

        @if (!empty($logerro->updated_at))
          {{ $logerro->hora->formatLocalized('%h %m') }}
        @endif
      </p>
  </div>
</div>
</div>
</div>
</div>

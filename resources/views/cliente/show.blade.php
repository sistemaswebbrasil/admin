<div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
            <h3 class="profile-username text-center">{{ $permission->name }}</h3>
            <p class="text-muted text-center">{{ $permission->display_name }}</p>

        </div>

    </div>
</div>

<div class="col-md-9">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('geral.detalhes') }}</h3>
  </div>
  <div class="box-body">
      <strong><i class="fa fa-book margin-r-5"></i> {{ trans('geral.description') }}</strong>
      <p class="text-muted">
        {{ $permission->description }}
    </p>
    <hr>
    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('geral.roles') }}</strong>
    <p>
        @foreach ($permission->roles as $role)
        <span class="label label-info"> {{ $role->display_name }}</span>
        @endforeach
    </p>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('geral.created_at') }}</strong>
        </p>
        @if (!empty($permission->created_at))
          {{ $permission->created_at->diffForHumans() }}
        @endif
        </p>
    </div>
    <div class="col-md-6">
      <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('geral.updated_at') }}</strong>
      </p>

        @if (!empty($permission->updated_at))
          {{ $permission->updated_at->formatLocalized('%d %B %Y') }}
        @endif
      </p>
  </div>
</div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
            <h3 class="profile-username text-center">{{ $role->name }}</h3>
            <p class="text-muted text-center">{{ $role->display_name }}</p>

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
        {{ $role->description }}
    </p>
    <hr>
    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('geral.permissions') }}</strong>
    <p>
        @foreach ($role->permissions as $permission)
        <span class="label label-info"> {{ $permission->display_name }}</span>
        @endforeach
    </p>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('geral.created_at') }}</strong>
        </p>
        @if (!empty($role->created_at))
          {{ $role->created_at->diffForHumans() }}
        @endif
        </p>
    </div>
    <div class="col-md-6">
      <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('geral.updated_at') }}</strong>
      </p>

        @if (!empty($role->updated_at))
          {{ $role->updated_at->formatLocalized('%d %B %Y') }}
        @endif
      </p>
  </div>
</div>
</div>
</div>
</div>

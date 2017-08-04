<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <h3 class="profile-username text-center">
                    {{ $menuacesso->text }}
                </h3>
                <p class="text-muted text-center">
                    {{ $menuacesso->url }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    {{ trans('geral.detalhes') }}
                </h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong>
                            <i class="fa fa-book margin-r-5">
                            </i>
                            {{ trans('geral.icon') }}
                        </strong>
                        <p>
                            {{ $menuacesso->icon  }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <strong>
                            <i class="fa fa-book margin-r-5">
                            </i>
                            {{ trans('geral.icon_color') }}
                        </strong>
                        <p>
                            {{ $menuacesso->icon_color  }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <strong>
                            <i class="fa fa-book margin-r-5">
                            </i>
                            {{ trans('geral.label') }}
                        </strong>
                        <p>
                            {{ $menuacesso->label  }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <strong>
                            <i class="fa fa-book margin-r-5">
                            </i>
                            {{ trans('geral.permission') }}
                        </strong>
                        <p>
                            {{ $menuacesso->permission  }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <strong>
                            <i class="fa fa-book margin-r-5">
                            </i>
                            {{ trans('geral.target') }}
                        </strong>
                        <p>
                            {{ $menuacesso->target  }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <strong>
                            <i class="fa fa-book margin-r-5">
                            </i>
                            {{ trans('geral.target') }}
                        </strong>
                        <p>
                            {{ $menuacesso->target  }}
                        </p>
                    </div>
                </div>
                <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>
                                <i class="fa fa-file-text-o margin-r-5">
                                </i>
                                {{ trans('geral.created_at') }}
                            </strong>
                            @if (!empty($menuacesso->created_at))
                            <p>
                                {{ $menuacesso->created_at->diffForHumans() }}
                            </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <strong>
                                <i class="fa fa-file-text-o margin-r-5">
                                </i>
                                {{ trans('geral.updated_at') }}
                            </strong>
                            @if (!empty($menuacesso->updated_at))
                            <p>
                                {{ $menuacesso->updated_at->formatLocalized('%d %B %Y') }}
                            </p>
                            @endif
                        </div>
                    </div>
                </hr>
            </div>
        </div>
    </div>
</div>

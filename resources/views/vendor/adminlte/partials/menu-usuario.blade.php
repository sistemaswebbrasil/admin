<li class="dropdown user user-menu">

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
      <img src={{ Auth::user()->avatar }} class="user-image" alt="User Image">
      <span class="hidden-xs">{{ Auth::user()->name }}</span>
    </a>
    <ul class="dropdown-menu">

      <li class="user-header">
        <img src={{ Auth::user()->avatar }} class="img-circle" alt="User Image">
        <p>
          {{ Auth::user()->name }}                      

        </p> 
      </li>


      <li class="user-footer">
        <div class="pull-left">
          <a href="{{ route('usuario.profile') }}" class="btn btn-default btn-flat">{{ trans('geral.editar') }}</a>                       
        </div>

        <div class="pull-right">
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
          {{ trans('geral.sair') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </div>
    </li>
  </ul>
</li>



<!-- 
<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a> -->
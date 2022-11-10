<div class="form-inline mr-auto">
  <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg" ><i class="mdi mdi-menu" style="font-size: 24px;"></i></a></li>
  </ul>
</div>
<ul class="navbar-nav navbar-right">
  <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img @if(Auth::user()->avatar) src="{{asset('/storage/avatars/'.Auth::user()->avatar)}}" @else avatar="{{ Auth::user()->name }}" @endif alt="user-image" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
      <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="mdi mdi-logout mr-1"></i> {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>
  </li>
</ul>

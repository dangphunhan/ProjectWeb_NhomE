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
      @foreach(Auth::user()->workspace as $workspace)

          <a href="@if($currantWorkspace->id == $workspace->id)#@else{{ route('change_workspace',$workspace->id) }}@endif" title="{{ $workspace->name }}" class="dropdown-item notify-item">
            @if($currantWorkspace->id == $workspace->id)
              <i class="mdi mdi-check"></i>
            @endif
            <span>{{ $workspace->name }}</span>
            @if(isset($workspace->pivot->permission))
              @if($workspace->pivot->permission =='Owner')
                <span class="badge badge-primary">{{$workspace->pivot->permission}}</span>
              @else
                <span class="badge badge-secondary">{{__('Shared')}}</span>
              @endif
            @endif
          </a>

      @endforeach
      @if(isset($currantWorkspace) && $currantWorkspace)
        <div class="dropdown-divider"></div>
      @endif

        <a href="#" class="dropdown-item notify-item" data-toggle="modal" data-target="#modelCreateWorkspace">
          <i class="mdi mdi-plus"></i>
          <span>{{ __('Create New Workspace')}}</span>
        </a>
      @if(isset($currantWorkspace) && $currantWorkspace)
        @if(Auth::user()->id == $currantWorkspace->created_by)
          <a href="#" class="dropdown-item notify-item" onclick="(confirm('Are you sure ?')?document.getElementById('remove-workspace-form').submit(): '');">
            <i class=" mdi mdi-delete-outline"></i>
            <span>{{ __('Remove Me From This Workspace')}}</span>
          </a>
          <form id="remove-workspace-form" action="{{ route('delete_workspace', ['id' => $currantWorkspace->id]) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
          </form>
        @else
          <a href="#" class="dropdown-item notify-item" onclick="(confirm('Are you sure ?')?document.getElementById('remove-workspace-form').submit(): '');">
            <i class=" mdi mdi-delete-outline"></i>
            <span>{{ __('Leave Me From This Workspace')}}</span>
          </a>
          <form id="remove-workspace-form" action="{{ route('leave_workspace', ['id' => $currantWorkspace->id]) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
          </form>
        @endif
      @endif

        <div class="dropdown-divider"></div>
      <div class="dropdown-divider"></div>
      <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="mdi mdi-logout mr-1"></i> {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>
  </li>
</ul>

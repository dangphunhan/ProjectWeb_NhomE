<div class="form-inline mr-auto">
  <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg" ><i class="mdi mdi-menu" style="font-size: 24px;"></i></a></li>
  </ul>
</div>
<ul class="navbar-nav navbar-right">
  <?php if(isset($currantWorkspace) && $currantWorkspace && $currantWorkspace->permission == 'Owner'): ?>
    <?php
      $currantLang = basename(App::getLocale());
    ?>
  <?php endif; ?>
  <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img <?php if(Auth::user()->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.Auth::user()->avatar)); ?>" <?php else: ?> avatar="<?php echo e(Auth::user()->name); ?>" <?php endif; ?> alt="user-image" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">Hi, <?php echo e(Auth::user()->name); ?></div></a>
    <div class="dropdown-menu dropdown-menu-right">

      <a href="<?php echo e(route('users.my.account')); ?>" class="dropdown-item has-icon">
        <i class="mdi mdi-account-circle mr-1"></i> <?php echo e(__('My Account')); ?>

      </a>
      <div class="dropdown-divider"></div>
      <a href="<?php echo e(route('logout')); ?>" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="mdi mdi-logout mr-1"></i> <?php echo e(__('Logout')); ?>

      </a>
      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
      </form>
    </div>
  </li>
</ul>
<?php /**PATH D:\web2\updateUser\resources\views/partials/topnav.blade.php ENDPATH**/ ?>
<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="<?php echo e(route('home')); ?>">
        <img style="width: 50px" height="50px" src="<?php echo e(asset(Storage::url('logo/th.jpg'))); ?>" alt="<?php echo e(env('APP_NAME')); ?>" height="35">
    </a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset(Storage::url('logo/th.jpg'))); ?>" alt="<?php echo e(env('APP_NAME')); ?>" height="25"></a>
  </div>
  <ul class="sidebar-menu">
      <li class="<?php echo e((Request::route()->getName() == 'home' || Request::route()->getName() == NULL) ? ' active' : ''); ?>">
          <a class="nav-link" href="<?php echo e(route('home')); ?>">
              <i class="dripicons-home"></i> <span> <?php echo e(__('Dashboard')); ?> </span>
          </a>
      </li>
      <?php if(isset($currantWorkspace) && $currantWorkspace): ?>
          <li class="<?php echo e((Request::route()->getName() == 'projects.index') ? ' active' : ''); ?>">
              <a class="nav-link" href="#">
                  <i class="dripicons-briefcase"></i>
                  <span> <?php echo e(__('Projects')); ?> </span>
              </a>
          </li>
          <li class="<?php echo e((Request::route()->getName() == 'users.index') ? ' active' : ''); ?>">
              <a href="#">
                  <i class="dripicons-network-3"></i>
                  <span> <?php echo e(__('Users')); ?> </span>
              </a>
          </li>
          <?php if($currantWorkspace->creater->id == Auth::user()->id): ?>
              <li class="<?php echo e((Request::route()->getName() == 'clients.index') ? ' active' : ''); ?>">
                  <a href="#">
                      <i class="dripicons-user"></i>
                      <span> <?php echo e(__('Clients')); ?> </span>
                  </a>
              </li>
          <?php endif; ?>
          <li class="<?php echo e((Request::route()->getName() == 'calender.index') ? ' active' : ''); ?>">
              <a href="#">
                  <i class="dripicons-calendar"></i>
                  <span> <?php echo e(__('Calendar')); ?> </span>
              </a>
          </li>
          <li class="<?php echo e((Request::route()->getName() == 'notes.index') ? ' active' : ''); ?>">
              <a href="#">
                  <i class="dripicons-clipboard"></i>
                  <span> <?php echo e(__('Notes')); ?> </span>
              </a>
          </li>
      <?php endif; ?>
    </ul>
</aside>
<?php /**PATH D:\web2\login\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>
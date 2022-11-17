<?php $__env->startSection('content'); ?>
    <section class="section">
        <?php if($currantWorkspace): ?>
            <h2 class="section-title"><?php echo e(__('Dashboard')); ?></h2>

            <div class="row">
                <div class="col-12">
                    <div class="card widget-inline">
                        <div class="card-body p-0">
                            <div class="row no-gutters">
                                <div class="col-sm-6 col-xl-4 animated">
                                    <div class="card shadow-none m-0">
                                        <div class="card-body text-center">
                                            <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                            <h3><span><?php echo e($totalProject); ?></span></h3>
                                            <p class="text-muted font-15 mb-0"><?php echo e(__('Total Projects')); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-4 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                            <h3><span><?php echo e($totalTask); ?></span></h3>
                                            <p class="text-muted font-15 mb-0"><?php echo e(__('Total Tasks')); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-4 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                            <h3><span><?php echo e($totalMembers); ?></span></h3>
                                            <p class="text-muted font-15 mb-0"><?php echo e(__('Members')); ?></p>
                                        </div>
                                    </div>
                                </div>

                               

                            </div> <!-- end row -->
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-12">
                    <div class="card animated">
                        <div class="card-header">
                            <h4><?php echo e(__('Workspaces')); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php $__currentLoopData = Auth::user()->workspace; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workspace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4">
                                        <?php if($currantWorkspace->id == $workspace->id): ?>
                                        <div class="card mb-0 mt-3 bg-secondary" style="height: 50px;">
                                            <a href="<?php if($currantWorkspace->id == $workspace->id): ?> #<?php else: ?><?php echo e(route('change_workspace', $workspace->id)); ?> <?php endif; ?>"
                                                title="<?php echo e($workspace->name); ?>">
                                                <div class="abc">
                                                    <?php if(isset($workspace->pivot->permission)): ?>
                                                        <?php if($workspace->pivot->permission == 'Owner'): ?>
                                                            <span
                                                                class="badge badge-secondary"><?php echo e($workspace->pivot->permission); ?></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary"><?php echo e(__('Shared')); ?></span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                        <i class="mdi mdi-check" style="color:green "></i>
                                                    <h5 class="ani"
                                                        style="text-align: center; color: #000; font-family: cursive">
                                                        <?php echo e($workspace->name); ?></h5>
                                                </div>
                                            </a>
                                        </div>
                                        <?php else: ?>
                                        <div class="card mb-0 mt-3 bg-dark" style="height: 50px;">
                                            <a href="<?php if($currantWorkspace->id == $workspace->id): ?> #<?php else: ?><?php echo e(route('change_workspace', $workspace->id)); ?> <?php endif; ?>"
                                                title="<?php echo e($workspace->name); ?>">
                                                <div class="abc">
                                                    <?php if(isset($workspace->pivot->permission)): ?>
                                                        <?php if($workspace->pivot->permission == 'Owner'): ?>
                                                            <span
                                                                class="badge badge-secondary"><?php echo e($workspace->pivot->permission); ?></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary"><?php echo e(__('Shared')); ?></span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <h5 class="ani"
                                                        style="text-align: center; color: #fff; font-family: cursive">
                                                        <?php echo e($workspace->name); ?></h5>
                                                </div>
                                            </a>
                                        </div>
                                         <?php endif; ?>   
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card animated">
                        <div class="card-header">
                            <h4><?php echo e(__('Tasks')); ?></h4>
                        </div>
                        <div class="card-body">

                            <p><b><?php echo e($completeTask); ?></b> <?php echo e(__('Tasks completed out of')); ?> <?php echo e($totalTask); ?></p>

                            <div class="table-responsive">
                                <table class="table table-centered table-hover mb-0 animated">
                                    <tbody>
                                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="font-14 my-1"><a
                                                            href="<?php echo e(route('projects.task.board', [$currantWorkspace->slug, $task->project_id])); ?>"
                                                            class="text-body"><?php echo e($task->title); ?></a></div>
                                                    <span class="text-muted font-13"><?php echo e(__('Due in')); ?>

                                                        <?php echo e(\App\Utility::get_timeago(strtotime($task->due_date))); ?></span>
                                                </td>
                                                <td>
                                                    <span class="text-muted font-13"><?php echo e(__('Status')); ?></span> <br />
                                                    <?php if($task->status == 'todo'): ?>
                                                        <span
                                                            class="badge badge-primary"><?php echo e(ucfirst($task->status)); ?></span>
                                                    <?php elseif($task->status == 'in progress'): ?>
                                                        <span
                                                            class="badge badge-warning"><?php echo e(ucfirst($task->status)); ?></span>
                                                    <?php elseif($task->status == 'review'): ?>
                                                        <span
                                                            class="badge badge-danger"><?php echo e(ucfirst($task->status)); ?></span>
                                                    <?php elseif($task->status == 'done'): ?>
                                                        <span
                                                            class="badge badge-success"><?php echo e(ucfirst($task->status)); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="text-muted font-13"><?php echo e(__('Project')); ?></span>
                                                    <div class="font-14 mt-1 font-weight-normal"><?php echo e($task->project->name); ?>

                                                    </div>
                                                </td>
                                                <?php if($currantWorkspace->permission == 'Owner'): ?>
                                                    <td>
                                                        <span class="text-muted font-13"><?php echo e(__('Assigned to')); ?></span>
                                                        <div class="font-14 mt-1 font-weight-normal">
                                                            <?php echo e($task->user->name); ?></div>
                                                    </td>
                                                <?php endif; ?>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-ver2\resources\views/home.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>

    <section class="section">
    <?php if($currantWorkspace): ?>
            <h2 class="section-title"><?php echo e(__('Projects')); ?></h2>

            <div class="row">
                <div class="col-12">
                    <div class="card widget-inline">
                        <div class="card-body p-0">
                            <div class="row no-gutters">
                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0">
                                        <div class="card-body text-center">
                                            <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                            <h3><span>0</span></h3>
                                            <p class="text-muted font-15 mb-0"><?php echo e(__('Total Projects')); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                            <h3><span>0</span></h3>
                                            <p class="text-muted font-15 mb-0"><?php echo e(__('Total Tasks')); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                            <h3><span>0</span></h3>
                                            <p class="text-muted font-15 mb-0"><?php echo e(__('Members')); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                            <h3><span>0</span></h3>
                                            <p class="text-muted font-15 mb-0"><?php echo e(__('Clients')); ?></p>
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
                            <h4><?php echo e(__('Tasks Overview')); ?></h4>
                        </div>
                        <div class="card-body">

                            <div class="mt-3 chartjs-chart" style="height: 320px;">
                                <canvas id="task-area-chart"></canvas>
                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->


            <div class="row">
                <div class="col-xl-4">
                    <div class="card animated">
                        <div class="card-header">
                            <h4><?php echo e(__('Project Status')); ?></h4>
                        </div>
                        <div class="card-body">

                            <div class="my-4 chartjs-chart" style="height: 202px;">
                                <canvas id="project-status-chart"></canvas>
                            </div>
                            <!-- end row-->
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

                <div class="col-xl-8">
                    <div class="card animated">
                        <div class="card-header">
                            <h4><?php echo e(__('Tasks')); ?></h4>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- end row-->
    <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web2\User\resources\views/home.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>

    <section class="section">

        <?php if($project && $currantWorkspace): ?>
        <div class="row mb-2">
            <div class="col-sm-4">
                <h2 class="section-title"><?php echo e(__('Project Detail')); ?></h2>
            </div>
            <div class="col-sm-8">
                <div class="text-sm-right">
                    <div class="btn-group mt-4">
                        <a href="<?php echo e(route('projects.task.board',[$currantWorkspace->slug,$project->id])); ?>" class="btn btn-primary"><?php echo e(__('Task Board')); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 animated">
                <!-- project card -->
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="card-header-action">
                            <div class="dropdown card-widgets">
                                <a href="#" class="btn active dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="dripicons-gear"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php if($currantWorkspace->permission == 'Owner'): ?>
                                        <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Project')); ?>" data-url="<?php echo e(route('projects.edit',[$currantWorkspace->slug,$project->id])); ?>"><i class="mdi mdi-pencil mr-1"></i><?php echo e(__('Edit')); ?></a>
                                        <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-<?php echo e($project->id); ?>').submit(): '');" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i><?php echo e(__('Delete')); ?></a>
                                        <form id="delete-form-<?php echo e($project->id); ?>" action="<?php echo e(route('projects.destroy',[$currantWorkspace->slug,$project->id])); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                        <a href="#" class="dropdown-item" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Invite Users')); ?>" data-url="<?php echo e(route('projects.invite.popup',[$currantWorkspace->slug,$project->id])); ?>"><i class="mdi mdi-email-outline mr-1"></i><?php echo e(__('Invite')); ?></a>
                                        
                                    <?php else: ?>
                                        <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('leave-form-<?php echo e($project->id); ?>').submit(): '');" class="dropdown-item"><i class="mdi mdi-exit-to-app mr-1"></i><?php echo e(__('Leave')); ?></a>
                                        <form id="leave-form-<?php echo e($project->id); ?>" action="<?php echo e(route('projects.leave',[$currantWorkspace->slug,$project->id])); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- project title-->
                        <div class="author-box-name">
                           <?php echo e($project->name); ?>

                        </div>
                        <div class="author-box-job">
                            <?php if($project->status == 'Finished'): ?>
                                <div class="badge badge-success"><?php echo e(__('Finished')); ?></div>
                            <?php elseif($project->status == 'Ongoing'): ?>
                                <div class="badge badge-secondary"><?php echo e(__('Ongoing')); ?></div>
                            <?php else: ?>
                                <div class="badge badge-warning"><?php echo e(__('OnHold')); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-4 font-weight-bold"><?php echo e(__('Project Overview')); ?>:</div>

                        <div class="author-box-description">
                            <?php echo e($project->description); ?>

                        </div>

                        <div class="row mt-3">
                            <?php if($project->start_date): ?>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <div class="font-weight-bold"><?php echo e(__('Start Date')); ?></div>
                                    <p> <?php echo e(date('d M Y',strtotime($project->start_date))); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($project->end_date): ?>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <div class="font-weight-bold"><?php echo e(__('End Date')); ?></div>
                                    <p> <?php echo e(date('d M Y',strtotime($project->end_date))); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <div class="font-weight-bold"><?php echo e(__('Budget')); ?></div>
                                    <p>$<?php echo e(number_format($project->budget)); ?></p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="font-weight-bold mb-2"><?php echo e(__('Team Members')); ?>:</div>

                            <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <figure class="avatar mr-2 avatar-sm animated" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e($user->name); ?>">
                                    <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.$user->avatar)); ?>" <?php else: ?> avatar="<?php echo e($user->name); ?>"<?php endif; ?> class="rounded-circle">
                                </figure>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div> <!-- end card-body-->

                </div> <!-- end card-->

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas mdi mdi-clock-outline"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4><?php echo e(__('Days left')); ?></h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $datetime1 = new DateTime($project->end_date);
                                        $datetime2 = new DateTime(date('Y-m-d'));
                                        $interval = $datetime1->diff($datetime2);
                                        $days = $interval->format('%a')
                                    ?>
                                    <?php echo e($days); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon shadow-danger bg-danger">
                                <i class="fas mdi mdi-format-list-checkbox"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4><?php echo e(__('Total task')); ?></h4>
                                </div>
                                <div class="card-body">
                                    <?php echo e($project->countTask()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon shadow-success bg-success">
                                <i class="fas mdi mdi-message-outline"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4><?php echo e(__('Comments')); ?></h4>
                                </div>
                                <div class="card-body">
                                    <?php echo e($project->countTaskComments()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="card-header-action">
                            <div class="dropdown card-widgets">
                                <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Create Milestone')); ?>" data-url="<?php echo e(route('projects.milestone',[$currantWorkspace->slug,$project->id])); ?>"><?php echo e(__('Create Milestone')); ?></a>
                            </div>
                        </div>
                        <!-- project title-->
                        <div class="author-box-name mb-4">
                            <?php echo e(__('Milestones')); ?> (<?php echo e(count($project->milestones)); ?>)
                        </div>

                        <?php $__currentLoopData = $project->milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="ribbon-wrapper  bg-white b-all mb-4 milestones">
                                <div class="ribbon ribbon-corner"><span class="milestone-count">#<?php echo e($key+1); ?></span></div>
                                <div class="ribbon-content">
                                    <h5 class="media-heading text-info font-light">
                                        <a href="#" class="milestone-detail" data-ajax-popup="true" data-title="<?php echo e(__('Milestones Details')); ?>" data-url="<?php echo e(route('projects.milestone.show',[$currantWorkspace->slug,$milestone->id])); ?>"><?php echo e($milestone->title); ?></a>
                                        <div class="float-right">
                                            <small>
                                                <a href="#" class="btn btn-sm btn-outline-primary" data-ajax-popup="true" data-title="<?php echo e(__('Edit Milestone')); ?>" data-url="<?php echo e(route('projects.milestone.edit',[$currantWorkspace->slug,$milestone->id])); ?>"><i class="mdi mdi-pencil"></i></a>
                                                <a href="#" class="btn btn-sm btn-outline-danger" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form1-<?php echo e($milestone->id); ?>').submit(): '');"><i class="mdi mdi-delete"></i></a>
                                                <form id="delete-form1-<?php echo e($milestone->id); ?>" action="<?php echo e(route('projects.milestone.destroy',[$currantWorkspace->slug,$milestone->id])); ?>" method="POST" style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            </small>
                                        </div>
                                    </h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <?php if($milestone->status == 'incomplete'): ?>
                                                <label class="badge badge-warning"><?php echo e(__('Incomplete')); ?></label>
                                            <?php endif; ?>
                                            <?php if($milestone->status == 'complete'): ?>
                                                <label class="badge badge-success"><?php echo e(__('Complete')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-6 text-right">
                                            <strong><?php echo e(__('Milestone Cost')); ?>:</strong> $<?php echo e(number_format($milestone->cost)); ?>

                                        </div>
                                        <div class="col-12">
                                            <?php echo e($milestone->summary); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div> <!-- end card-body-->

                </div> <!-- end card-->
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="author-box-name mb-4">
                            <?php echo e(__('Files')); ?>

                        </div>
                        <div class="col-md-12 dropzone" id="dropzonewidget"></div>
                    </div>
                </div>

                <!-- end card-->
            </div> <!-- end col -->

            <div class="col-md-4 animated">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4><?php echo e(__('Activity')); ?></h4>
                    </div>
                    <div class="card-body"  style="height: 900px;overflow-y: scroll">
                        <div class="activities">
                            <?php $__currentLoopData = $project->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="activity">
                                    <?php if($activity->log_type == 'Move'): ?>
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-cursor-move"></i>
                                        </div>
                                    <?php elseif($activity->log_type == 'Create Milestone'): ?>
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-target"></i>
                                        </div>
                                    <?php elseif($activity->log_type == 'Create Task'): ?>
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-format-list-checks"></i>
                                        </div>
                                    <?php elseif($activity->log_type == 'Invite User'): ?>
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-plus"></i>
                                        </div>
                                    <?php elseif($activity->log_type == 'Upload File'): ?>
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-file"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="activity-detail">
                                        <div class="mb-2">
                                            <span class="text-job"><?php echo e($activity->created_at->diffForHumans()); ?></span>
                                        </div>
                                        <p><?php echo $activity->remark; ?></p>
                                    </div>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php else: ?>
            <div class="container mt-5">
                <div class="page-error">
                    <div class="page-inner">
                        <h1>404</h1>
                        <div class="page-description">
                            <?php echo e(__('Page Not Found')); ?>

                        </div>
                        <div class="page-search">
                            <p class="text-muted mt-3"><?php echo e(__('It\'s looking like you may have taken a wrong turn. Don\'t worry... it happens to the best of us. Here\'s a little tip that might help you get back on track.')); ?></p>
                            <div class="mt-3">
                                <a class="btn btn-info mt-3" href="<?php echo e(route('home')); ?>"><i class="mdi mdi-reply"></i> <?php echo e(__('Return Home')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dropzone.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <!-- third party js -->
    <script src="<?php echo e(asset('assets/js/vendor/Chart.bundle.min.js')); ?>"></script>
    <script>
window.onload = function() {
			var ctx = document.getElementById('line-chart-example').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};

    </script>
    <!-- third party js ends -->

    <script src="<?php echo e(asset('assets/js/dropzone.min.js')); ?>"></script>
    <script>
        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#dropzonewidget",{
            maxFiles: 20,
            maxFilesize: 2,
            parallelUploads: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "<?php echo e(route('projects.file.upload',[$currantWorkspace->slug,$project->id])); ?>",
            success: function(file, response){
                if(response.is_success){
                    dropzoneBtn(file,response);
                }else{
                    myDropzone.removeFile(file);
                    toastr('Error',response.error,'error');
                }
            },
            error: function (file, response) {
                myDropzone.removeFile(file);
                if(response.error) {
                    toastr('Error', response.error,'error');
                }else{
                    toastr('Error', response,'error');
                }
            }
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("project_id", <?php echo e($project->id); ?>);
        });
        function dropzoneBtn(file,response) {
            var download = document.createElement('a');
            download.setAttribute('href',response.download);
            download.setAttribute('class',"btn btn btn-outline-primary btn-sm mt-1 mr-1");
            download.setAttribute('data-toggle',"tooltip");
            download.setAttribute('data-original-title',"<?php echo e(__('Download')); ?>");
            download.innerHTML = "<i class='mdi mdi-download'></i>";

            var del = document.createElement('a');
            del.setAttribute('href',response.delete);
            del.setAttribute('class',"btn btn-outline-danger btn-sm mt-1");
            del.setAttribute('data-toggle',"tooltip");
            del.setAttribute('data-original-title',"<?php echo e(__('Delete')); ?>");
            del.innerHTML = "<i class='mdi mdi-delete'></i>";

            del.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                if(confirm("Are you sure ?")) {
                    var btn = $(this);
                    $.ajax({
                        url: btn.attr('href'),
                        data: {_token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'DELETE',
                        success: function (response) {
                            if(response.is_success) {
                                btn.closest('.dz-image-preview').remove();
                            }else{
                                toastr('Error', response.error,'error');
                            }
                        },
                        error: function (response) {
                            response = response.responseJSON;
                            if(response.is_success) {
                                toastr('Error', response.error,'error');
                            }else{
                                toastr('Error', response,'error');
                            }
                        }
                    })
                }
            });

            var html = document.createElement('div');
            html.appendChild(download);
            html.appendChild(del);

            file.previewTemplate.appendChild(html);
        }

        <?php
            $files = $project->files;
        ?>
        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        // Create the mock file:
        var mockFile = { name: "<?php echo e($file->file_name); ?>", size: <?php echo e(filesize(storage_path('project_files/'.$file->file_path))); ?> };
        // Call the default addedfile event handler
        myDropzone.emit("addedfile", mockFile);
        // And optionally show the thumbnail of the file:
        myDropzone.emit("thumbnail", mockFile, "<?php echo e(asset('storage/project_files/'.$file->file_path)); ?>");
        myDropzone.emit("complete", mockFile);
        dropzoneBtn(mockFile,{download:"<?php echo e(route('projects.file.download',[$currantWorkspace->slug,$project->id,$file->id])); ?>",delete:"<?php echo e(route('projects.file.delete',[$currantWorkspace->slug,$project->id,$file->id])); ?>"});

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CDWeb2\Project_CDWeb1_NhomE - Copy\resources\views/projects/show.blade.php ENDPATH**/ ?>
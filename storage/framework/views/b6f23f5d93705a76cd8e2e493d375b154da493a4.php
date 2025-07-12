<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Workorder')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('workorder.index')); ?>"><?php echo e(__('Workorder')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(workOrderPrefix().$workorder->wo_id); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php
    $admin_logo=getSettingsValByName('company_logo');
    $settings=settings();
?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '.print', function () {
            var printContents = document.getElementById('invoice-print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            $('.invoice-action').addClass('d-none');
            window.print();
            $('.invoice-action').removeClass('d-none');
            document.body.innerHTML = originalContents;
        });

        $(document).on('click', '.workorderStatusChange', function () {
            var workorderStatus = this.value;
            var workorderUrl = $(this).data('url');
            $.ajax({
                url: workorderUrl + '?status=' + workorderStatus,
                type: 'GET',
                cache: false,
                success: function (data) {
                    location.reload();
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('card-action-btn'); ?>

    <a class="btn btn-warning print " href="javascript:void(0);"> <?php echo e(__('Print')); ?></a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="col-sm-12 product-detail-page wo_detail">
        <div class="product-card product-detail-tab">
            <ul class="nav nav-tabs">
                <li>
                    <a class="btn <?php echo e(empty(session('active_tab'))?'active':''); ?>" data-bs-toggle="tab"
                       href="#service_part"><?php echo e(__('Services and Parts')); ?> </a>
                </li>
                <li>
                    <a class="btn <?php echo e(session('active_tab')=='service_task'?'active show':''); ?>" data-bs-toggle="tab"
                       href="#service_task"><?php echo e(__('Service Tasks')); ?> </a>
                </li>
                <li>
                    <a class="btn <?php echo e(session('active_tab')=='service_appointment'?'active show':''); ?>"
                       data-bs-toggle="tab" href="#service_appointment"><?php echo e(__('Service Appointment')); ?> </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade  <?php echo e(empty(session('active_tab'))?'active show':''); ?>" id="service_part">
                    <div id="invoice-print">
                        <div class="card-body cdx-invoice">
                            <div id="cdx-invoice">
                                <div class="head-invoice">
                                    <div class="codex-brand">
                                        <a class="codexbrand-logo" href="Javascript:void(0);">
                                            <img class="img-fluid invoice-logo"
                                                 src=" <?php echo e(asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')); ?>"
                                                 alt="invoice-logo">
                                        </a>
                                        <a class="codexdark-logo" href="Javascript:void(0);">
                                            <img class="img-fluid invoice-logo"
                                                 src=" <?php echo e(asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')); ?>"
                                                 alt="invoice-logo">
                                        </a>
                                    </div>
                                    <ul class="contact-list">

                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-user"></i>
                                            </div><?php echo e($settings['company_name']); ?>

                                        </li>
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-phone"></i>
                                            </div><?php echo e($settings['company_phone']); ?>

                                        </li>
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-envelope"></i>
                                            </div><?php echo e($settings['company_email']); ?>

                                        </li>

                                    </ul>
                                </div>
                                <div class="invoice-user">
                                    <div class="left-user">
                                        <h5><?php echo e(__('Client')); ?>:</h5>
                                        <ul class="detail-list">
                                            <li>
                                                <div class="icon-wrap"><i class="fa fa-user"></i></div>
                                                <?php echo e(!empty($workorder->clients)?$workorder->clients->name:''); ?>

                                                (<?php echo e(!empty($workorder->clients) && !empty($workorder->clients->clients)?$workorder->clients->clients->company:''); ?>

                                                )
                                            </li>
                                            <li>
                                                <div class="icon-wrap"><i class="fa fa-phone"></i>
                                                </div><?php echo e(!empty($workorder->clients)?$workorder->clients->phone_number:''); ?>

                                            </li>
                                        </ul>

                                        <h6 class="mt-10 text-primary"><?php echo e(__('Service Address')); ?>:</h6>
                                        <ul class="detail-list">
                                            <li>
                                                <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                                                <?php echo e(!empty($workorder->clients) && !empty($workorder->clients->clients)?$workorder->clients->clients->service_address:''); ?>

                                                <?php if(!empty($workorder->clients) && !empty($workorder->clients->clients) && !empty($workorder->clients->clients->service_city)): ?>
                                                    <br>  <?php echo e($workorder->clients->clients->service_city); ?>

                                                    ,  <?php echo e($workorder->clients->clients->service_state); ?>

                                                    , <?php echo e($workorder->clients->clients->service_country); ?>,
                                                    <?php echo e($workorder->clients->clients->service_zip_code); ?>

                                                <?php endif; ?>

                                            </li>
                                        </ul>

                                        <h6 class="mt-10 text-primary"><?php echo e(__('Billing Address')); ?>:</h6>
                                        <ul class="detail-list">
                                            <li>
                                                <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                                                <?php echo e(!empty($workorder->clients) && !empty($workorder->clients->clients)?$workorder->clients->clients->billing_address:''); ?>

                                                <?php if(!empty($workorder->clients) && !empty($workorder->clients->clients) && !empty($workorder->clients->clients->billing_city)): ?>
                                                    <br>  <?php echo e($workorder->clients->clients->billing_city); ?>

                                                    ,  <?php echo e($workorder->clients->clients->billing_state); ?>

                                                    , <?php echo e($workorder->clients->clients->billing_country); ?>,
                                                    <?php echo e($workorder->clients->clients->billing_zip_code); ?>

                                                <?php endif; ?>

                                            </li>
                                        </ul>


                                    </div>

                                    <div class="right-user">
                                        <ul class="detail-list">
                                            <li><?php echo e(__('Workorder No')); ?>:
                                                <span><?php echo e(workOrderPrefix().$workorder->wo_id); ?> </span></li>
                                            <li><?php echo e(__('Assign To')); ?>:
                                                <span> <?php echo e(!empty($workorder->assigned)?$workorder->assigned->name:'-'); ?>  </span>
                                            </li>
                                            <li><?php echo e(__('Asset')); ?>:
                                                <span><?php echo e(!empty($workorder->assets)?$workorder->assets->name:'-'); ?> </span>
                                            </li>
                                            <li><?php echo e(__('Due Date')); ?>:
                                                <span> <?php echo e(dateFormat($workorder->due_date)); ?> </span>
                                            </li>
                                            <li><?php echo e(__('Type')); ?>:
                                                <span><?php echo e(!empty($workorder->types)?$workorder->types->type:'-'); ?> </span>
                                            </li>

                                            <li><?php echo e(__('Status')); ?>:
                                                <?php if($workorder->status=='pending'): ?>
                                                    <span
                                                        class="badge badge-warning"><?php echo e(\App\Models\Workorder::$status[$workorder->status]); ?></span>
                                                <?php elseif($workorder->status=='on_hold'): ?>
                                                    <span
                                                        class="badge badge-primary"><?php echo e(\App\Models\Workorder::$status[$workorder->status]); ?></span>
                                                <?php elseif($workorder->status=='approved' || $workorder->status=='completed'): ?>
                                                    <span
                                                        class="badge badge-success"><?php echo e(\App\Models\Workorder::$status[$workorder->status]); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="badge badge-danger"><?php echo e(\App\Models\Workorder::$status[$workorder->status]); ?></span>
                                                <?php endif; ?>

                                            </li>
                                            <li class="mt-5"><?php echo e(__('Priority')); ?>:
                                                <?php if($workorder->priority=='low'): ?>
                                                    <span
                                                        class="badge badge-primary"><?php echo e(\App\Models\WORequest::$priority[$workorder->priority]); ?></span>
                                                <?php elseif($workorder->priority=='medium'): ?>
                                                    <span
                                                        class="badge badge-info"><?php echo e(\App\Models\WORequest::$priority[$workorder->priority]); ?></span>
                                                <?php elseif($workorder->priority=='high'): ?>
                                                    <span
                                                        class="badge badge-warning"><?php echo e(\App\Models\WORequest::$priority[$workorder->priority]); ?></span>
                                                <?php elseif($workorder->priority=='critical'): ?>
                                                    <span
                                                        class="badge badge-danger"><?php echo e(\App\Models\WORequest::$priority[$workorder->priority]); ?></span>
                                                <?php endif; ?>

                                            </li>


                                        </ul>
                                    </div>
                                </div>

                                <div class="body-invoice">
                                    <div class="table-responsive1">
                                        <table class="table ml-1">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('Service')); ?></th>
                                                <th><?php echo e(__('Quantity')); ?></th>
                                                <th><?php echo e(__('Description')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $workorder->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(!empty($service->serviceParts)?$service->serviceParts->title:'-'); ?></td>
                                                    <td><?php echo e($service->quantity); ?> <?php echo e(!empty($service->serviceParts)?$service->serviceParts->unit:''); ?></td>
                                                    <td><?php echo e(!empty($service->description)?$service->description:'-'); ?></td>
                                                    <td><?php echo e(priceFormat($service->amount)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="body-invoice">
                                    <div class="table-responsive1">
                                        <table class="table ml-1">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('Part')); ?></th>
                                                <th><?php echo e(__('Quantity')); ?></th>
                                                <th><?php echo e(__('Description')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $workorder->parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e(!empty($part->serviceParts)?$part->serviceParts->title:'-'); ?>

                                                    </td>
                                                    <td><?php echo e($part->quantity); ?> <?php echo e(!empty($part->serviceParts)?$part->serviceParts->unit:''); ?></td>
                                                    <td><?php echo e(!empty($part->description)?$part->description:'-'); ?></td>
                                                    <td><?php echo e(priceFormat($part->amount)); ?></td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="footer-invoice">
                                    <table class="table">
                                        <tr>
                                            <td><?php echo e(__('Grand Total')); ?></td>
                                            <td><?php echo e(priceFormat($workorder->getWorkorderTotalAmount())); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <?php if(!empty($workorder->notes)): ?>
                                            <?php echo e(__('Notes')); ?> : <p><?php echo e($workorder->notes); ?></p>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <?php if(Gate::check('estimation status change')): ?>
                                    <div class="invoice-action">
                                        <div class="small-group">
                                            <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <div class="chek-group">
                                            <span class="custom-check-input custom-chek">
                                            <input class="form-check-input workorderStatusChange" type="radio"
                                                   value="<?php echo e($k); ?>"
                                                   <?php echo e(($workorder->status==$k)?'checked':''); ?> id="<?php echo e($val); ?>"
                                                   data-url="<?php echo e(route('workorder.status',$workorder->id)); ?>"
                                                   name="status"></span>
                                                        <label class="ml-5" for="<?php echo e($val); ?>"><?php echo e($val); ?></label>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade  <?php echo e(session('active_tab')=='service_task'?'active show':''); ?>"
                     id="service_task">
                    <div class=" project-summarytbl">
                        <div class="card-header text-end">
                            <?php if(Gate::check('create workorder service task')): ?>
                                <a class="btn btn-primary btn-sm me-2 customModal float-right" href="#"
                                   data-url="<?php echo e(route('workorder.service.task.create',$workorder->id)); ?>" data-size="md"
                                   data-title="<?php echo e(__('Create Service Task')); ?>"> <i class="ti-plus mr-5"></i>
                                    <?php echo e(__('Create Task')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Service')); ?></th>
                                        <th><?php echo e(__('Service Task')); ?></th>
                                        <th><?php echo e(__('Task Duration')); ?></th>
                                        <th><?php echo e(__('Description')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th>#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $workorder->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(!empty($task->services)?$task->services->title:'-'); ?></td>
                                            <td><?php echo e($task->service_task); ?></td>
                                            <td><?php echo e($task->duration); ?></td>
                                            <td><?php echo e($task->description); ?></td>
                                            <td>
                                                <?php if($task->status=='pending'): ?>
                                                    <span
                                                        class="badge badge-warning"><?php echo e(\App\Models\WOServiceTask::$status[$task->status]); ?></span>
                                                <?php elseif($task->status=='in_progress'): ?>
                                                    <span
                                                        class="badge badge-primary"><?php echo e(\App\Models\WOServiceTask::$status[$task->status]); ?></span>
                                                <?php elseif($task->status=='on_hold'): ?>
                                                    <span
                                                        class="badge badge-danger"><?php echo e(\App\Models\WOServiceTask::$status[$task->status]); ?></span>
                                                <?php elseif($task->status=='completed'): ?>
                                                    <span
                                                        class="badge badge-success"><?php echo e(\App\Models\WOServiceTask::$status[$task->status]); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="cart-action">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['workorder.service.task.destroy', $workorder->id,$task->id]]); ?>


                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit workorder service task')): ?>
                                                        <a class="text-success customModal" data-bs-toggle="tooltip"
                                                           data-size="md"
                                                           data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                           data-url="<?php echo e(route('workorder.service.task.edit',[$workorder->id,$task->id])); ?>"
                                                           data-title="<?php echo e(__('Edit Task')); ?>"> <i data-feather="edit"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete workorder service task')): ?>
                                                        <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                           data-bs-original-title="<?php echo e(__('Detete')); ?>" href="#"> <i
                                                                data-feather="trash-2"></i></a>
                                                    <?php endif; ?>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade  <?php echo e(session('active_tab')=='service_appointment'?'active show':''); ?>"
                     id="service_appointment">
                    <div class=" project-summarytbl">
                        <div class="card-header text-end">
                            <?php if(Gate::check('create service appointment')): ?>
                                <a class="btn btn-primary btn-sm me-2 customModal float-right" href="#"
                                   data-url="<?php echo e(route('workorder.service.appointment',$workorder->id)); ?>" data-size="md"
                                   data-title="<?php echo e(__('Service Appointment')); ?>">
                                    <?php echo e(__('Service Appointment')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Start Date')); ?></th>
                                        <th><?php echo e(__('Start Time')); ?></th>
                                        <th><?php echo e(__('End Date')); ?></th>
                                        <th><?php echo e(__('End Time')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th><?php echo e(__('Description')); ?></th>
                                        <th>#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $appointment=$workorder->appointments; ?>
                                    <?php if(!empty($appointment)): ?>
                                        <tr>
                                            <td><?php echo e(dateFormat($appointment->start_date)); ?></td>
                                            <td><?php echo e(timeFormat($appointment->start_time)); ?></td>
                                            <td><?php echo e(dateFormat($appointment->end_date)); ?></td>
                                            <td><?php echo e(timeFormat($appointment->end_time)); ?></td>

                                            <td>
                                                <?php if(in_array($appointment->status,['pending','on_hold'])): ?>
                                                    <span
                                                        class="badge badge-warning"><?php echo e(\App\Models\WOServiceAppointment::$status[$appointment->status]); ?></span>
                                                <?php elseif(in_array($appointment->status,['schedule','reschedule'])): ?>
                                                    <span
                                                        class="badge badge-primary"><?php echo e(\App\Models\WOServiceAppointment::$status[$appointment->status]); ?></span>
                                                <?php elseif($appointment->status=='dispatched'): ?>
                                                    <span
                                                        class="badge badge-info"><?php echo e(\App\Models\WOServiceAppointment::$status[$appointment->status]); ?></span>
                                                <?php elseif($appointment->status=='completed'): ?>
                                                    <span
                                                        class="badge badge-success"><?php echo e(\App\Models\WOServiceAppointment::$status[$appointment->status]); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="badge badge-danger"><?php echo e(\App\Models\WOServiceAppointment::$status[$appointment->status]); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($appointment->notes); ?></td>
                                            <td>
                                                <div class="cart-action">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['workorder.service.appointment.destroy', $workorder->id]]); ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete service appointment')): ?>
                                                        <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                           data-bs-original-title="<?php echo e(__('Detete')); ?>" href="#"> <i
                                                                data-feather="trash-2"></i></a>
                                                    <?php endif; ?>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/workorder/show.blade.php ENDPATH**/ ?>
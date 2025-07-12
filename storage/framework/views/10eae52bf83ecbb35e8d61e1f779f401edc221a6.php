<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Work Order Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Work Order Request')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create wo request')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="<?php echo e(route('wo-request.create')); ?>"
           data-title="<?php echo e(__('Create WO Request')); ?>"> <i
                class="ti-plus mr-5"></i>
            <?php echo e(__('Create WO Request')); ?>

        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Request')); ?></th>
                            <th><?php echo e(__('Client')); ?></th>
                            <th><?php echo e(__('Asset')); ?></th>
                            <th><?php echo e(__('Due Date')); ?></th>
                            <th><?php echo e(__('Priority')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Assign')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $woRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($woRequest->request_detail); ?> </td>
                                <td><?php echo e(!empty($woRequest->clients)?$woRequest->clients->name:'-'); ?> </td>
                                <td><?php echo e(!empty($woRequest->assets)?$woRequest->assets->name:'-'); ?> </td>
                                <td><?php echo e(dateFormat($woRequest->due_date)); ?> </td>

                                <td>
                                    <?php if($woRequest->priority=='low'): ?>
                                        <span
                                            class="badge badge-primary"><?php echo e(\App\Models\WORequest::$priority[$woRequest->priority]); ?></span>
                                    <?php elseif($woRequest->priority=='medium'): ?>
                                        <span
                                            class="badge badge-info"><?php echo e(\App\Models\WORequest::$priority[$woRequest->priority]); ?></span>
                                    <?php elseif($woRequest->priority=='high'): ?>
                                        <span
                                            class="badge badge-warning"><?php echo e(\App\Models\WORequest::$priority[$woRequest->priority]); ?></span>
                                    <?php elseif($woRequest->priority=='critical'): ?>
                                        <span
                                            class="badge badge-danger"><?php echo e(\App\Models\WORequest::$priority[$woRequest->priority]); ?></span>
                                    <?php endif; ?>

                                </td>

                                <td>
                                    <?php if($woRequest->status=='pending'): ?>
                                        <span
                                            class="badge badge-warning"><?php echo e(\App\Models\WORequest::$status[$woRequest->status]); ?></span>
                                    <?php elseif($woRequest->status=='in_progress'): ?>
                                        <span
                                            class="badge badge-primary"><?php echo e(\App\Models\WORequest::$status[$woRequest->status]); ?></span>
                                    <?php elseif($woRequest->status=='completed'): ?>
                                        <span
                                            class="badge badge-success"><?php echo e(\App\Models\WORequest::$status[$woRequest->status]); ?></span>
                                    <?php elseif($woRequest->status=='cancel'): ?>
                                        <span
                                            class="badge badge-danger"><?php echo e(\App\Models\WORequest::$status[$woRequest->status]); ?></span>
                                    <?php endif; ?>

                                </td>
                                <td><?php echo e(!empty($woRequest->assigned)?$woRequest->assigned->name:'-'); ?> </td>
                                <td>
                                    <div class="cart-action">
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['wo-request.destroy', $woRequest->id]]); ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show wo request')): ?>
                                            <a class="text-warning customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="<?php echo e(__('Details')); ?>" href="#"
                                               data-url="<?php echo e(route('wo-request.show',$woRequest->id)); ?>"
                                               data-title="<?php echo e(__('WO Request Detail')); ?>"> <i data-feather="eye"></i></a>

                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit wo request')): ?>
                                            <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                               data-url="<?php echo e(route('wo-request.edit',$woRequest->id)); ?>"
                                               data-title="<?php echo e(__('Edit WO Request')); ?>"> <i data-feather="edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete wo request')): ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\thupsel\resources\views/wo_request/index.blade.php ENDPATH**/ ?>
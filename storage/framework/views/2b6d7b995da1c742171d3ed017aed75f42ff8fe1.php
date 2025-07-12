<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Work Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Work Order')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create work order')): ?>
        <a class="btn btn-primary btn-sm ml-20" href="<?php echo e(route('workorder.create')); ?>"> <i class="ti-plus mr-5"></i>
            <?php echo e(__('Create Workorder')); ?>

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
                            <th><?php echo e(__('ID')); ?></th>
                            <th><?php echo e(__('Detail')); ?></th>
                            <th><?php echo e(__('Type')); ?></th>
                            <th><?php echo e(__('Client')); ?></th>
                            <th><?php echo e(__('Asset')); ?></th>
                            <th><?php echo e(__('Due Date')); ?></th>
                            <th><?php echo e(__('Priority')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Assign')); ?></th>
                            <th><?php echo e(__('Total')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $workorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workorder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(workOrderPrefix().$workorder->wo_id); ?> </td>
                                <td><?php echo e($workorder->wo_detail); ?> </td>
                                <td><?php echo e(!empty($workorder->types)?$workorder->types->type:'-'); ?> </td>
                                <td><?php echo e(!empty($workorder->clients)?$workorder->clients->name:'-'); ?> </td>
                                <td><?php echo e(!empty($workorder->assets)?$workorder->assets->name:'-'); ?> </td>
                                <td><?php echo e(dateFormat($workorder->due_date)); ?> </td>
                                <td>
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
                                </td>
                                <td>
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

                                </td>
                                <td><?php echo e(!empty($workorder->assigned)?$workorder->assigned->name:'-'); ?> </td>
                                <td><?php echo e(priceFormat($workorder->getWorkorderTotalAmount())); ?></td>
                                <td>
                                    <div class="cart-action">
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['workorder.destroy', $workorder->id]]); ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show work order')): ?>
                                            <a class="text-warning" data-bs-toggle="tooltip"  href="<?php echo e(route('workorder.show',\Illuminate\Support\Facades\Crypt::encrypt($workorder->id))); ?>"
                                               data-title="<?php echo e(__('Workorder Detail')); ?>"> <i data-feather="eye"></i></a>

                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit work order')): ?>
                                            <a class="text-success" data-bs-toggle="tooltip" href="<?php echo e(route('workorder.edit',\Illuminate\Support\Facades\Crypt::encrypt($workorder->id))); ?>"
                                              data-title="<?php echo e(__('Edit Workorder')); ?>"> <i data-feather="edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete work order')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\thupsel\resources\views/workorder/index.blade.php ENDPATH**/ ?>
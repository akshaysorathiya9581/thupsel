<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Estimation')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Estimation')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create estimation')): ?>
        <a class="btn btn-primary btn-sm ml-20" href="<?php echo e(route('estimation.create')); ?>" > <i
                class="ti-plus mr-5"></i>
            <?php echo e(__('Create Estimation')); ?>

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
                            <th><?php echo e(__('Title')); ?></th>
                            <th><?php echo e(__('Client')); ?></th>
                            <th><?php echo e(__('Asset')); ?></th>
                            <th><?php echo e(__('Amount')); ?></th>
                            <th><?php echo e(__('Due Date')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $estimations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estimation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(estimationPrefix().$estimation->estimation_id); ?> </td>
                                <td><?php echo e($estimation->title); ?> </td>
                                <td><?php echo e(!empty($estimation->clients)?$estimation->clients->name:'-'); ?> </td>
                                <td><?php echo e(!empty($estimation->assets)?$estimation->assets->name:'-'); ?> </td>
                                <td><?php echo e(priceFormat($estimation->getEstimationSubTotalAmount())); ?> </td>
                                <td><?php echo e(dateFormat($estimation->due_date)); ?> </td>
                                <td>
                                    <?php if($estimation->status=='pending'): ?>
                                        <span
                                            class="badge badge-warning"><?php echo e(\App\Models\Estimation::$status[$estimation->status]); ?></span>
                                    <?php elseif($estimation->status=='on_hold'): ?>
                                        <span
                                            class="badge badge-primary"><?php echo e(\App\Models\Estimation::$status[$estimation->status]); ?></span>
                                    <?php elseif($estimation->status=='approved' || $estimation->status=='completed'): ?>
                                        <span
                                            class="badge badge-success"><?php echo e(\App\Models\Estimation::$status[$estimation->status]); ?></span>
                                    <?php else: ?>
                                        <span
                                            class="badge badge-danger"><?php echo e(\App\Models\Estimation::$status[$estimation->status]); ?></span>
                                    <?php endif; ?>

                                </td>

                                <td>
                                    <div class="cart-action">
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['estimation.destroy', $estimation->id]]); ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show estimation')): ?>
                                            <a class="text-warning" data-bs-toggle="tooltip" href="<?php echo e(route('estimation.show',\Illuminate\Support\Facades\Crypt::encrypt($estimation->id))); ?>"
                                               data-title="<?php echo e(__('Estimation Detail')); ?>"> <i data-feather="eye"></i></a>

                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit estimation')): ?>
                                            <a class="text-success" data-bs-toggle="tooltip"
                                               data-bs-original-title="<?php echo e(__('Edit')); ?>" href="<?php echo e(route('estimation.edit',\Illuminate\Support\Facades\Crypt::encrypt($estimation->id))); ?>"> <i data-feather="edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete estimation')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/estimation/index.blade.php ENDPATH**/ ?>
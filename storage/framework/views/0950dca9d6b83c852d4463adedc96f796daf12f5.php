<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Assets')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Assets')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create asset')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="<?php echo e(route('asset.create')); ?>"
           data-title="<?php echo e(__('Create Asset')); ?>"> <i
                class="ti-plus mr-5"></i>
            <?php echo e(__('Create Asset')); ?>

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
                            <th><?php echo e(__('Name')); ?></th>
                            <th><?php echo e(__('Asset Number')); ?></th>
                            <th><?php echo e(__('Part')); ?></th>
                            <th><?php echo e(__('Parent Asset')); ?></th>
                            <th><?php echo e(__('GIAI')); ?></th>
                            <th><?php echo e(__('Order')); ?></th>
                            <th><?php echo e(__('Purchase')); ?></th>
                            <th><?php echo e(__('Installation')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($asset->name); ?> </td>
                                <td><?php echo e($asset->asset_number); ?> </td>
                                <td><?php echo e(!empty($asset->parts)?$asset->parts->title:'-'); ?> </td>
                                <td><?php echo e(!empty($asset->parents)?$asset->parents->name:'-'); ?> </td>
                                <td><?php echo e($asset->giai); ?> </td>
                                <td><?php echo e(dateFormat($asset->order_date)); ?> </td>
                                <td><?php echo e(dateFormat($asset->purchase_date)); ?> </td>
                                <td><?php echo e(dateFormat($asset->installation_date)); ?> </td>
                                <td>
                                    <div class="cart-action">
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['asset.destroy', $asset->id]]); ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show asset')): ?>
                                            <a class="text-warning customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="<?php echo e(__('Details')); ?>" href="#"
                                               data-url="<?php echo e(route('asset.show',$asset->id)); ?>"
                                               data-title="<?php echo e(__('Asset Detail')); ?>"> <i data-feather="eye"></i></a>

                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit asset')): ?>
                                            <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                               data-url="<?php echo e(route('asset.edit',$asset->id)); ?>"
                                               data-title="<?php echo e(__('Edit Asset')); ?>"> <i data-feather="edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete asset')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\thupsel\resources\views/asset/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Inventory Items')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create service & part')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="<?php echo e(route('services-parts.create')); ?>"
           data-title="<?php echo e(__('Create Inventory Items')); ?>"> <i
                class="ti-plus mr-5"></i>
            <?php echo e(__('Create Inventory Items')); ?>

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
                            <th><?php echo e(__('Title')); ?></th>
                            <th><?php echo e(__('No of Qty')); ?></th>
                            <th><?php echo e(__('Price')); ?></th>
                            <th><?php echo e(__('Unit')); ?></th>
                            <th><?php echo e(__('Type')); ?></th>
                            <th><?php echo e(__('Description')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $serviceParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicePart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($servicePart->title); ?> </td>
                                <td><?php echo e($servicePart->sku); ?> </td>
                                <td><?php echo e(priceFormat($servicePart->price)); ?> </td>
                                <td><?php echo e($servicePart->unit); ?> </td>
                                <td><?php echo e(ucfirst($servicePart->type)); ?> </td>
                                <td><?php echo e(!empty($servicePart->description)?$servicePart->description:"-"); ?> </td>
                                <td>
                                    <div class="cart-action">
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['services-parts.destroy', $servicePart->id]]); ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show service & part')): ?>
                                            <a class="text-warning customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="<?php echo e(__('Details')); ?>" href="#"
                                               data-url="<?php echo e(route('services-parts.show',$servicePart->id)); ?>"
                                               data-title="<?php echo e(__('Inventory Detail')); ?>"> <i data-feather="eye"></i></a>

                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit service & part')): ?>
                                            <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                               data-url="<?php echo e(route('services-parts.edit',$servicePart->id)); ?>"
                                               data-title="<?php echo e(__('Edit Inventory Items')); ?>"> <i data-feather="edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete service & part')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\thupsel\resources\views/service_part/index.blade.php ENDPATH**/ ?>
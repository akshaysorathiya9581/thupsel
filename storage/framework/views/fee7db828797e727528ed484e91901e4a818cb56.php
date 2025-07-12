<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Client')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Client')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create client')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="<?php echo e(route('client.create')); ?>"
           data-title="<?php echo e(__('Create Client')); ?>"> <i
                class="ti-plus mr-5"></i>
            <?php echo e(__('Create Client')); ?>

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
                            <th><?php echo e(__('Name')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th><?php echo e(__('Phone Number')); ?></th>
                            <th><?php echo e(__('Company')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(clientPrefix()); ?><?php echo e(!empty($client->clients)?$client->clients->client_id:''); ?> </td>
                                <td><?php echo e($client->name); ?> </td>
                                <td><?php echo e($client->email); ?> </td>
                                <td><?php echo e(!empty($client->phone_number)?$client->phone_number:'-'); ?> </td>
                                <td><?php echo e(!empty($client->clients) && !empty($client->clients->company)?$client->clients->company:'-'); ?> </td>
                                <td>
                                    <div class="cart-action">
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['client.destroy', $client->id]]); ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show client')): ?>
                                            <a class="text-warning" data-bs-toggle="tooltip"
                                               data-bs-original-title="<?php echo e(__('Details')); ?>" href="<?php echo e(route('client.show',\Illuminate\Support\Facades\Crypt::encrypt($client->id))); ?>"
                                               > <i data-feather="eye"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit client')): ?>
                                            <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                               data-url="<?php echo e(route('client.edit',$client->id)); ?>"
                                               data-title="<?php echo e(__('Edit Client')); ?>"> <i data-feather="edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete client')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\thupsel\resources\views/client/index.blade.php ENDPATH**/ ?>
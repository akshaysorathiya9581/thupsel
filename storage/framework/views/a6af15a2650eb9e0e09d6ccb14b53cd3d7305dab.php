<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(__('Invoice')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create invoice')): ?>
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="<?php echo e(route('invoice.create')); ?>"
           data-title="<?php echo e(__('Create Invoice')); ?>"> <i
                class="ti-plus mr-5"></i>
            <?php echo e(__('Create Invoice')); ?>

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
                            <th><?php echo e(__('Client')); ?></th>
                            <th><?php echo e(__('Workorder')); ?></th>
                            <th><?php echo e(__('Invoice Date')); ?></th>
                            <th><?php echo e(__('Due Date')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Total')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a href="<?php echo e(route('invoice.show',\Illuminate\Support\Facades\Crypt::encrypt($invoice->id))); ?>"><?php echo e(invoicePrefix().$invoice->invoice_id); ?></a> </td>
                                <td><?php echo e(!empty($invoice->clients)?$invoice->clients->name:'-'); ?> </td>
                                <td><a href="<?php echo e(route('workorder.show',\Illuminate\Support\Facades\Crypt::encrypt($invoice->wo_id))); ?>"><?php echo e(workOrderPrefix()); ?><?php echo e(!empty($invoice->workorders)?$invoice->workorders->wo_id:''); ?></a></td>
                                <td><?php echo e(dateFormat($invoice->invoice_date)); ?> </td>
                                <td><?php echo e(dateFormat($invoice->due_date)); ?> </td>
                                <td>
                                    <?php if($invoice->status=='paid'): ?>
                                        <span
                                            class="badge badge-success"><?php echo e(\App\Models\Invoice::$status[$invoice->status]); ?></span>
                                    <?php else: ?>
                                        <span
                                            class="badge badge-danger"><?php echo e(\App\Models\Invoice::$status[$invoice->status]); ?></span>
                                    <?php endif; ?>

                                </td>
                                <td><?php echo e(priceFormat($invoice->total-$invoice->discount)); ?>  </td>
                                <td>
                                    <div class="cart-action">
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoice.destroy', $invoice->id]]); ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show invoice')): ?>
                                            <a class="text-warning" data-bs-toggle="tooltip"
                                               data-bs-original-title="<?php echo e(__('Details')); ?>" href="<?php echo e(route('invoice.show',\Illuminate\Support\Facades\Crypt::encrypt($invoice->id))); ?>"> <i data-feather="eye"></i></a>

                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                            <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                               data-url="<?php echo e(route('invoice.edit',$invoice->id)); ?>"
                                               data-title="<?php echo e(__('Edit Invoice')); ?>"> <i data-feather="edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/invoice/index.blade.php ENDPATH**/ ?>
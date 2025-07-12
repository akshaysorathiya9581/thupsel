<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('invoice.index')); ?>"><?php echo e(__('Invoice')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(invoicePrefix().$invoice->invoice_id); ?></a>
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

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('card-action-btn'); ?>
    <a class="btn btn-warning print me-2" href="javascript:void(0);"> <?php echo e(__('Print')); ?></a>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
        <a class="btn btn-primary customModal"  data-size="lg"
         href="#"
           data-url="<?php echo e(route('invoice.edit',$invoice->id)); ?>"
           data-title="<?php echo e(__('Edit Invoice')); ?>">  <?php echo e(__('Edit')); ?></a>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="invoice-print">
        <div class="card">
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
                                <li>
                                    <?php echo e(__('Invoice No')); ?>:
                                    <span><?php echo e(invoicePrefix().$invoice->invoice_id); ?> </span>
                                </li>
                                <li>
                                    <?php echo e(__('Work Order No')); ?>:
                                    <span><?php echo e(workOrderPrefix().$workorder->wo_id); ?> </span>
                                </li>

                                <li>
                                    <?php echo e(__('Invoice Date')); ?>:
                                    <span> <?php echo e(dateFormat($invoice->invoice_date)); ?> </span>
                                </li>
                                <li>
                                    <?php echo e(__('Due Date')); ?>:
                                    <span> <?php echo e(dateFormat($invoice->due_date)); ?> </span>
                                </li>


                                <li><?php echo e(__('Status')); ?>:
                                    <?php if($invoice->status=='paid'): ?>
                                        <span
                                            class="badge badge-success"><?php echo e(\App\Models\Invoice::$status[$invoice->status]); ?></span>
                                    <?php else: ?>
                                        <span
                                            class="badge badge-danger"><?php echo e(\App\Models\Invoice::$status[$invoice->status]); ?></span>
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
                                <td><?php echo e(__('Sub Total')); ?></td>
                                <td><?php echo e(priceFormat($workorder->getWorkorderTotalAmount())); ?></td>
                            </tr>
                            <?php if($invoice->discount>0): ?>
                            <tr>
                                <td><?php echo e(__('Discount')); ?></td>
                                <td><?php echo e(priceFormat($invoice->discount)); ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td><?php echo e(__('Grand Total')); ?></td>
                                <td><?php echo e(priceFormat($invoice->total-$invoice->discount)); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php if(!empty($invoice->notes)): ?>
                                <?php echo e(__('Notes')); ?> : <p><?php echo e($invoice->notes); ?></p>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\thupsel\resources\views/invoice/show.blade.php ENDPATH**/ ?>
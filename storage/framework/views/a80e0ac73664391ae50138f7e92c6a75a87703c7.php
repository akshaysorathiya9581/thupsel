<?php $__env->startSection('page-title'); ?>
    <?php echo e(clientPrefix()); ?><?php echo e(!empty($client->clients)?$client->clients->client_id:''); ?> <?php echo e(__('Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('client.index')); ?>"><?php echo e(__('Client')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                <?php echo e(clientPrefix()); ?><?php echo e(!empty($client->clients)?$client->clients->client_id:''); ?> <?php echo e(__('Details')); ?>

            </a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>  <?php echo e(clientPrefix()); ?><?php echo e(!empty($client->clients)?$client->clients->client_id:''); ?> <?php echo e(__('Details')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Name')); ?></h6>
                                <p class="mb-20"><?php echo e($client->name); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Email')); ?></h6>
                                <p class="mb-20"><?php echo e($client->email); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Phone Number')); ?></h6>
                                <p class="mb-20"><?php echo e($client->phone_number); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Company')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->company:'-'); ?> </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class=" col-md-12 mb-20">
                        <h5> <?php echo e(__('Service Address')); ?></h5>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Country')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->service_country:'-'); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('State')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->service_state:'-'); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('City')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->service_city:'-'); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Zip Code')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->service_zip_code:'-'); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Address')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->service_address:'-'); ?> </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class=" col-md-12 mb-20">
                        <h5> <?php echo e(__('Billing Address')); ?></h5>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Billing Country')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->billing_country:'-'); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Billing State')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->billing_state:'-'); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Billing City')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->billing_city:'-'); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Billing Zip Code')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->billing_zip_code:'-'); ?> </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="detail-group">
                                <h6><?php echo e(__('Billing Address')); ?></h6>
                                <p class="mb-20"><?php echo e(!empty($client->clients)?$client->clients->billing_address:'-'); ?> </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/client/show.blade.php ENDPATH**/ ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Google ReCaptcha Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    $settings=settings();
?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(__('Payment Settings')); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php echo e(Form::model($settings, array('route' => array('setting.google.recaptcha'), 'method' => 'post'))); ?>

                    <div class="row mt-2">
                        <div class="col-auto">
                            <?php echo e(Form::label('google_recaptcha',__('Google ReCaptch Enable'),array('class'=>'form-label'))); ?>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check custom-chek">
                                    <input class="form-check-input" type="checkbox" name="google_recaptcha" id="google_recaptch" <?php echo e($settings['google_recaptcha'] == 'on' ? 'checked' : ''); ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('recaptcha_key',__('Recaptcha Key'),array('class'=>'form-label'))); ?>

                            <?php echo e(Form::text('recaptcha_key',$settings['recaptcha_key'],['class'=>'form-control','placeholder'=>__('Enter recaptcha key')])); ?>

                        </div>
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('recaptcha_secret',__('Recaptcha Secret'),array('class'=>'form-label'))); ?>

                            <?php echo e(Form::text('recaptcha_secret',$settings['recaptcha_secret'],['class'=>'form-control ','placeholder'=>__('Enter recaptcha secret')])); ?>

                        </div>
                    </div>

                    <div class="text-right">
                        <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary btn-rounded'))); ?>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\thupsel\resources\views/settings/recaptcha.blade.php ENDPATH**/ ?>
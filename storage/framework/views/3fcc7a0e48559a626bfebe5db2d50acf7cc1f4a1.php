<?php $__env->startSection('tab-title'); ?>
    <?php echo e(__('Reset Password')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="codex-authbox">
        <div class="auth-header">
            <div class="auth-icon"><i class="fa fa-unlock-alt"></i></div>
            <h3><?php echo e(__('Reset your password')); ?></h3>
            <p><?php echo e(__('You have Successfully Verified Your Account. Enter')); ?> <br> <?php echo e(__('New Password Below.')); ?></p>
        </div>
        <?php echo e(Form::open(array('route'=>'password.update','method'=>'post','id'=>'loginForm'))); ?>

        <input type="hidden" name="token" value="<?php echo e($request->route('token')); ?>">
        <div class="form-group">
            <?php echo e(Form::label('email',__('Email Address'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('email',$request->get('email'),array('class'=>'form-control','placeholder'=>__('Enter Your Email')))); ?>

            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-email text-danger" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label class="form-label" for="password"><?php echo e(__('New Password')); ?></label>
            <div class="input-group group-input">
                <input class="form-control showhide-password" type="password" id="password" name="password"
                       placeholder="<?php echo e(__('Enter Your New Password')); ?>" >
                <span class="input-group-text toggle-show fa fa-eye"></span>
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-password text-danger" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label class="form-label" for="newpassword"><?php echo e(__('Confirm Password')); ?></label>
            <div class="input-group group-input">
                <input class="form-control showhide-password" type="password" id="password_confirmation"
                       name="password_confirmation" placeholder="Re Enter Your Password" >
                <span class="input-group-text toggle-show fa fa-eye"></span>
            </div>
            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-password_confirmation text-danger" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-primary" type="submit"><?php echo e(__('Update Password')); ?></button>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>
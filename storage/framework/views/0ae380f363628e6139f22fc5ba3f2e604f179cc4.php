<?php echo e(Form::open(array('url'=>'coupons','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('name',__('Coupon Name'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter coupon name')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('type',__('Coupon Type'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('type',$type,null,array('class'=>'form-control hidesearch'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('code',__('Coupon Code'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('code',null,array('class'=>'form-control','placeholder'=>__('Enter coupon code')))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('rate',__('Discount Rate'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('rate',null,array('class'=>'form-control','placeholder'=>__('Enter coupon discount rate')))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('valid_for',__('Valid For'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('valid_for',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('use_limit',__('Number Of Times This Coupon Can Be Used'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('use_limit',null,array('class'=>'form-control','placeholder'=>__('Enter coupon use limit')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('applicable_packages',__('Applicable Packages'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('applicable_packages[]',$packages,null,array('class'=>'form-control hidesearch basic-select','multiple'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('status',__('Status'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('status',$status,null,array('class'=>'form-control hidesearch'))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary btn-rounded'))); ?>

</div>
<?php echo e(Form::close()); ?>



<?php /**PATH C:\xampp\htdocs\resources\views/coupon/create.blade.php ENDPATH**/ ?>
<?php echo e(Form::open(array('url'=>'wo-type','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('type',__('Type'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('type',null,array('class'=>'form-control','placeholder'=>__('Enter type'),'required'=>'required'))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\thupsel\resources\views/wo_type/create.blade.php ENDPATH**/ ?>
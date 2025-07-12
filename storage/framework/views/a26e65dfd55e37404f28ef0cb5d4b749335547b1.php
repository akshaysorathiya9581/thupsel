<?php echo e(Form::open(array('url'=>'asset','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name',__('Name'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter name'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('asset_number',__('Asset Number'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('asset_number',null,array('class'=>'form-control','placeholder'=>__('Enter asset number'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('part', __('Part'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo Form::select('part', $parts, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('parent_asset', __('Parent Asset'),['class'=>'form-label'])); ?>

            <?php echo Form::select('parent_asset', $assets, null,array('class' => 'form-control hidesearch')); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('giai',__('GIAI'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('giai',null,array('class'=>'form-control','placeholder'=>__('Enter giai')))); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('order_date',__('Order Date'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::date('order_date',null,array('class'=>'form-control','placeholder'=>__('Enter order date'),'required'=>'required'))); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('purchase_date',__('Purchase Date'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::date('purchase_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('installation_date',__('Installation Date'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::date('installation_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('warranty_expiration',__('Warranty Expiration'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('warranty_expiration',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('warranty_notes',__('Warranty Notes'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('warranty_notes',null,array('class'=>'form-control','rows'=>1))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description',__('Description'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\thupsel\resources\views/asset/create.blade.php ENDPATH**/ ?>
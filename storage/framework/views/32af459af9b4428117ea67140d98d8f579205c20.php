<?php echo e(Form::open(['url' => 'services-parts', 'method' => 'post'])); ?>

<div class="modal-body wrapper">
    <div class="row">
        <div class="form-group col-md-12">
            <div class="form-check custom-chek form-check-inline">
                <input class="form-check-input type" type="radio" value="part" id="part" name="type" checked>
                <label class="form-check-label" for="part"><?php echo e(__('Inventory')); ?></label>
            </div>
        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('title', __('Title'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter title'), 'required'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('sku', __('No of Qty'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('sku', null, ['class' => 'form-control', 'placeholder' => __('Enter no of qty'), 'required'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('price', __('Price'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('price', null, ['class' => 'form-control', 'placeholder' => __('Enter price'), 'required'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('unit', __('Unit'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('unit', null, ['class' => 'form-control', 'placeholder' => __('Enter unit')])); ?>

        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('description', null, ['class' => 'form-control', 'placeholder' => __('Enter description')])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-primary ml-10'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\thupsel\resources\views/service_part/create.blade.php ENDPATH**/ ?>
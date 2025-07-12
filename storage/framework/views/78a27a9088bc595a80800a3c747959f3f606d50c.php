<?php echo e(Form::model($invoice, array('route' => array('invoice.update', $invoice->id), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('invoice_id',__('Invoice Number'),array('class'=>'form-label'))); ?>

            <span class="text-danger">*</span>
            <div class="input-group">
                <span class="input-group-text ">
                  <?php echo e(invoicePrefix()); ?>

                </span>
                <?php echo e(Form::text('invoice_id',$invoice->invoice_id,array('class'=>'form-control','placeholder'=>__('Enter Invoice Number')))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('invoice_date',__('Invoice Date'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::date('invoice_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('total',__('Total Amount'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::number('total',null,array('class'=>'form-control','placeholder'=>__('Enter total amount'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('discount',__('Discount'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('discount',null,array('class'=>'form-control','placeholder'=>__('Enter discount')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('due_date',__('Due Date'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::date('due_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo Form::select('status', $status, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('notes',__('Notes'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('notes',null,array('class'=>'form-control','rows'=>2))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>




<?php /**PATH C:\xampp\htdocs\resources\views/invoice/edit.blade.php ENDPATH**/ ?>
<?php echo e(Form::open(array('url'=>'invoice','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('invoice_id',__('Invoice Number'),array('class'=>'form-label'))); ?>

            <span class="text-danger">*</span>
            <div class="input-group">
                <span class="input-group-text ">
                  <?php echo e(invoicePrefix()); ?>

                </span>
                <?php echo e(Form::text('invoice_id',$invoiceNumber,array('class'=>'form-control','placeholder'=>__('Enter Invoice Number')))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('invoice_date',__('Invoice Date'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::date('invoice_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('client', __('Client'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo Form::select('client', $clients, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('workorder',__('Work Order'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <div class="workorder_div">
                <select class="form-control hidesearch workorder" id="workorder" name="workorder">
                    <option value=""><?php echo e(__('Select Workorder')); ?></option>
                </select>
            </div>
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
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>

<script>
    // Document ready function
    $(document).ready(function() {
        // Initialize select2
        $('.hidesearch').select2({
            minimumResultsForSearch: -1
        });

        // Event handler for client change
        $('#client').on('change', function () {
            var client = $(this).val();
            var url = '<?php echo e(route("client.workorder")); ?>';
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    client: client,
                },
                type: 'GET',
                success: function (data) {
                    $('.workorder').empty().append('<option value=""><?php echo e(__('Select Workorder')); ?></option>');
                    $.each(data, function(key, value) {
                        $('.workorder').append('<option value="' + key + '">' + value + '</option>');
                    });

                },
            });
        });

        // Event delegation for workorder change
        $(document).on('change', '.workorder', function () {
            var workorder = $(this).val();
            var url = '<?php echo e(route("workorder.details")); ?>';
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    workorder: workorder,
                },
                type: 'GET',
                success: function (data) {
                    $('#total').val(data);
                },
            });
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\resources\views/invoice/create.blade.php ENDPATH**/ ?>
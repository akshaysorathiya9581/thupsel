<?php echo e(Form::model($serviceAppointment, array('route' => array('workorder.service.appointment.store', [$wo_id]), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('start_date',__('Start Date'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::date('start_date',null,array('class'=>'form-control','required'))); ?>

        </div>
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('start_time',__('Start Time'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::time('start_time',null,array('class'=>'form-control','required'))); ?>

        </div>
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('end_date',__('End Date'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::date('end_date',null,array('class'=>'form-control','required'))); ?>

        </div>
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('end_time',__('End Time'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::time('end_time',null,array('class'=>'form-control','required'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?>

            <?php echo Form::select('status', $status, null,array('class' => 'form-control hidesearch')); ?>

        </div>
        <div class="form-group ">
            <?php echo e(Form::label('notes',__('Notes'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('notes',null,array('class'=>'form-control','placeholder'=>__('Notes'),'rows'=>2))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\resources\views/workorder/service_appointment.blade.php ENDPATH**/ ?>
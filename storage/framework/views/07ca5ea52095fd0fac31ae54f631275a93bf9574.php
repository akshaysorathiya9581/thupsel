<?php echo e(Form::model($wORequest, array('route' => array('wo-request.update', $wORequest->id), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('request_detail',__('Request Detail'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::textarea('request_detail',null,array('class'=>'form-control','rows'=>1,'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('client', __('Client'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo Form::select('client', $clients, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('asset', __('Asset'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo Form::select('asset', $assets, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('due_date',__('Due Date'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::date('due_date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('priority', __('Priority'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo Form::select('priority', $priority, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo Form::select('status', $status, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('assign', __('Assign'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
            <?php echo Form::select('assign', $users, null,array('class' => 'form-control hidesearch')); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('notes',__('Notes'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('notes',null,array('class'=>'form-control','rows'=>2))); ?>

        </div>
        <hr>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('preferred_date',__('Preferred Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('preferred_date',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('preferred_time', __('Preferred Time'),['class'=>'form-label'])); ?>

            <?php echo Form::select('preferred_time', $time, null,array('class' => 'form-control hidesearch')); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('preferred_note',__('Preference Note'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('preferred_note',null,array('class'=>'form-control','rows'=>1))); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\thupsel\resources\views/wo_request/edit.blade.php ENDPATH**/ ?>
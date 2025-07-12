<?php echo e(Form::open(array('route'=>array('workorder.service.task.store',$workorder->id),'method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('service', __('Service'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
            <select class="form-control hidesearch" id="service" name="service" required="">
                <option value=""><?php echo e(__('Select Service')); ?></option>
                <?php $__currentLoopData = $woServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($service->serviceParts)): ?>
                        <option value="<?php echo e($service->serviceParts->id); ?>"><?php echo e($service->serviceParts->title); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('service_task',__('Task'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('service_task',null,array('class'=>'form-control','placeholder'=>__('service task title'),'required'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('duration',__('Duration'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('duration',null,array('class'=>'form-control','placeholder'=>__('like 1 Hour 20 Min'),'required'))); ?>

        </div>
        <div class="form-group ">
            <?php echo e(Form::label('description',__('Description'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('description',null,array('class'=>'form-control','placeholder'=>__('description')))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?>

            <?php echo Form::select('status', $status, null,array('class' => 'form-control hidesearch')); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\resources\views/workorder/service_task_create.blade.php ENDPATH**/ ?>
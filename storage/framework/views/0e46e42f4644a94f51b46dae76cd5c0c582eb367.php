<?php echo e(Form::model($servicePart, array('route' => array('services-parts.update', $servicePart->id), 'method' => 'PUT'))); ?>

<div class="modal-body wrapper">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('title',__('Title'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter title'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('sku',__('No of Qty'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('sku',null,array('class'=>'form-control','placeholder'=>__('Enter sku'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('price',__('Price'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('price',null,array('class'=>'form-control','placeholder'=>__('Enter price'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('unit',__('Unit'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('unit',null,array('class'=>'form-control','placeholder'=>__('Enter unit')))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description',__('Description'),array('class'=>'form-label'))); ?> <span class="text-danger">*</span>
            <?php echo e(Form::text('description',null,array('class'=>'form-control','placeholder'=>__('Enter description')))); ?>

        </div>
    </div>
    <?php if($servicePart->type=='service'): ?>
        <div class="service_tasks">
            <div class="row">
                <div class="col-sm-12">
                    <a href="#" class="btn btn-primary btn-xs service_task_clone float-end"><i
                                class="ti ti-plus"></i></a>
                </div>
            </div>
            <?php $__currentLoopData = $servicePart->serviceTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="id[]" value="<?php echo e($task->id); ?>">
                <div class="row service_task">
                    <div class="form-group col-md-4">
                        <?php echo e(Form::label('task',__('Service Task Title'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('task[]',$task->task,array('class'=>'form-control','placeholder'=>__('service task title')))); ?>

                    </div>
                    <div class="form-group col-md-3">
                        <?php echo e(Form::label('duration',__('Duration'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('duration[]',$task->duration,array('class'=>'form-control','placeholder'=>__('like 1 Hour 20 Min')))); ?>

                    </div>
                    <div class="form-group col-md-4">
                        <?php echo e(Form::label('task_description',__('Description'),array('class'=>'form-label'))); ?> <span
                                class="text-danger">*</span>
                        <?php echo e(Form::text('task_description[]',$task->description,array('class'=>'form-control','placeholder'=>__('description')))); ?>

                    </div>
                    <div class="col-auto">
                        <a href="#" class="fs-20 text-danger service_task_remove btn-sm "  data-val="<?php echo e($task->id); ?>"> <i
                                    class="ti ti-trash"></i></a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(count($servicePart->serviceTasks)==0): ?>
                <div class="row service_task">
                    <div class="form-group col-md-4">
                        <?php echo e(Form::label('task',__('Service Task Title'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('task[]',null,array('class'=>'form-control','placeholder'=>__('service task title')))); ?>

                    </div>
                    <div class="form-group col-md-3">
                        <?php echo e(Form::label('duration',__('Duration'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('duration[]',null,array('class'=>'form-control','placeholder'=>__('like 1 Hour 20 Min')))); ?>

                    </div>
                    <div class="form-group col-md-4">
                        <?php echo e(Form::label('task_description',__('Description'),array('class'=>'form-label'))); ?> <span
                                class="text-danger">*</span>
                        <?php echo e(Form::text('task_description[]',null,array('class'=>'form-control','placeholder'=>__('description')))); ?>

                    </div>
                    <div class="col-auto">
                        <a href="#" class="fs-20 text-danger service_task_remove btn-sm "> <i
                                    class="ti ti-trash"></i></a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="service_task_results"></div>
        </div>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary ml-10'))); ?>

</div>
<?php echo e(Form::close()); ?>

<script>
    $('.wrapper').on('click', '.service_task_remove', function () {
        var id=$(this).data('val');
        if(id!=''){
            if (confirm('Are you sure you want to delete this element?')) {
                $.ajax({
                    url: '<?php echo e(route('service.task.destroy')); ?>',
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    cache: false,
                    success: function (data) {

                    },
                });
            }
        }
        $('.schedule_remove').closest('.wrapper').find('.schedule').not(':first').last().remove();
    });

    $('.wrapper').on('click', '.service_task_remove', function () {
        $('.service_task_remove').closest('.wrapper').find('.service_task').not(':first').last().remove();
    });
    $('.wrapper').on('click', '.service_task_clone', function () {
        $('.service_task_clone').closest('.wrapper').find('.service_task').first().clone().appendTo('.service_task_results');
    });
</script>


<?php /**PATH C:\xampp\htdocs\thupsel\resources\views/service_part/edit.blade.php ENDPATH**/ ?>
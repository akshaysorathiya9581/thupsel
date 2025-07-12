<div class="modal-body wrapper">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Title')); ?></h6>
                <p class="mb-20"><?php echo e($servicePart->title); ?> </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('SKU')); ?></h6>
                <p class="mb-20"><?php echo e($servicePart->sku); ?> </p>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Price')); ?></h6>
                <p class="mb-20"> <?php echo e(priceFormat($servicePart->price)); ?></p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Unit')); ?></h6>
                <p class="mb-20"><?php echo e($servicePart->unit); ?></p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Type')); ?></h6>
                <p class="mb-20"><?php echo e(ucfirst($servicePart->type)); ?> </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Description')); ?></h6>
                <p class="mb-20"><?php echo e(!empty($servicePart->description)?$servicePart->description:"-"); ?></p>
            </div>
        </div>
    </div>

    <?php if(count($servicePart->serviceTasks)>0): ?>
    <div class=" col-md-12 mb-20">
        <h5> <?php echo e(__('Service Tasks')); ?></h5>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th><?php echo e(__('Task')); ?></th>
                    <th><?php echo e(__('Duration')); ?></th>
                    <th><?php echo e(__('Description')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $servicePart->serviceTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($task->task); ?></td>
                        <td><?php echo e($task->duration); ?></td>
                        <td><?php echo e($task->description); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php /**PATH C:\xampp\htdocs\resources\views/service_part/show.blade.php ENDPATH**/ ?>
<div class="modal-body wrapper">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="detail-group">
                <h6><?php echo e(__('Request Detail')); ?></h6>
                <p class="mb-20"><?php echo e($wORequest->request_detail); ?> </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Client')); ?></h6>
                <p class="mb-20"><?php echo e(!empty($wORequest->clients)?$wORequest->clients->name:'-'); ?></p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Asset')); ?></h6>
                <p class="mb-20"><?php echo e(!empty($wORequest->assets)?$wORequest->assets->name:'-'); ?></p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Due Date')); ?></h6>
                <p class="mb-20"><?php echo e(dateFormat($wORequest->due_date)); ?>  </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Priority')); ?></h6>
                <p class="mb-20">
                    <?php if($wORequest->priority=='low'): ?>
                        <span
                            class="badge badge-primary"><?php echo e(\App\Models\WORequest::$priority[$wORequest->priority]); ?></span>
                    <?php elseif($wORequest->priority=='medium'): ?>
                        <span
                            class="badge badge-info"><?php echo e(\App\Models\WORequest::$priority[$wORequest->priority]); ?></span>
                    <?php elseif($wORequest->priority=='high'): ?>
                        <span
                            class="badge badge-warning"><?php echo e(\App\Models\WORequest::$priority[$wORequest->priority]); ?></span>
                    <?php elseif($wORequest->priority=='critical'): ?>
                        <span
                            class="badge badge-danger"><?php echo e(\App\Models\WORequest::$priority[$wORequest->priority]); ?></span>
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Status')); ?></h6>
                <p class="mb-20">
                    <?php if($wORequest->status=='pending'): ?>
                        <span
                            class="badge badge-warning"><?php echo e(\App\Models\WORequest::$status[$wORequest->status]); ?></span>
                    <?php elseif($wORequest->status=='in_progress'): ?>
                        <span
                            class="badge badge-primary"><?php echo e(\App\Models\WORequest::$status[$wORequest->status]); ?></span>
                    <?php elseif($wORequest->status=='completed'): ?>
                        <span
                            class="badge badge-success"><?php echo e(\App\Models\WORequest::$status[$wORequest->status]); ?></span>
                    <?php elseif($wORequest->status=='cancel'): ?>
                        <span
                            class="badge badge-danger"><?php echo e(\App\Models\WORequest::$status[$wORequest->status]); ?></span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Assign')); ?></h6>
                <p class="mb-20"> <?php echo e(!empty($wORequest->assigned)?$wORequest->assigned->name:'-'); ?></p>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="detail-group">
                <h6><?php echo e(__('Notes')); ?></h6>
                <p class="mb-20"><?php echo e(!empty($wORequest->notes)?$wORequest->notes:"-"); ?></p>
            </div>
        </div>
        <hr>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Preferred Date')); ?></h6>
                <p class="mb-20"> <?php echo e(dateFormat($wORequest->preferred_date)); ?></p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6><?php echo e(__('Preferred Time')); ?></h6>
                <p class="mb-20"> <?php echo e($wORequest->preferred_time); ?></p>
            </div>
        </div>

        <div class="col-md-12 col-lg-12">
            <div class="detail-group">
                <h6><?php echo e(__('Preference Note')); ?></h6>
                <p class="mb-20"><?php echo e(!empty($wORequest->preferred_note)?$wORequest->preferred_note:"-"); ?></p>
            </div>
        </div>
    </div>

</div>

<?php /**PATH C:\xampp\htdocs\resources\views/wo_request/show.blade.php ENDPATH**/ ?>
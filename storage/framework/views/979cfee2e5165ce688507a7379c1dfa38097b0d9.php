<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Estimation')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.repeater.min.js')); ?>"></script>
    <script>
        var serviceSelector = "body .services";
        if ($(serviceSelector + " .repeater").length) {
            var $serviceRepeater = $(serviceSelector + ' .repeater').repeater({
                initEmpty: true,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $('.hidesearch').select2({
                        minimumResultsForSearch: -1
                    });
                    $(this).slideDown();
                },
                hide: function (deleteEstimation) {
                    if (confirm('Are you sure you want to delete this record?')) {
                        var id = $(this).find('.id').val();

                        $.ajax({
                            url: '<?php echo e(route('estimation.service.part.destroy')); ?>',
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                'id': id
                            },
                            cache: false,
                            success: function (result) {
                                $(this).slideUp(deleteEstimation);
                                $(this).remove();
                            },
                        });
                    }
                },
                isFirstItemUndeletable: true
            });
            var serviceValue = $(serviceSelector + " .repeater").attr('data-value');
            if (typeof serviceValue != 'undefined' && serviceValue.length != 0) {
                serviceValue = JSON.parse(serviceValue);
                $serviceRepeater.setList(serviceValue);
            }
        }

        var partSelector = "body .parts";
        if ($(partSelector + " .repeater").length) {
            var $partRepeater = $(partSelector + ' .repeater').repeater({
                initEmpty: true,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $('.hidesearch_part').select2({
                        minimumResultsForSearch: -1
                    });
                    $(this).slideDown();
                },
                hide: function (deleteEstimation) {
                    if (confirm('Are you sure you want to delete this record?')) {
                        var id = $(this).find('.id').val();

                        $.ajax({
                            url: '<?php echo e(route('estimation.service.part.destroy')); ?>',
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                'id': id
                            },
                            cache: false,
                            success: function (result) {
                                $(this).slideUp(deleteEstimation);
                                $(this).remove();
                            },
                        });
                    }
                },
                isFirstItemUndeletable: true
            });
            var partValue = $(partSelector + " .repeater").attr('data-value');
            if (typeof partValue != 'undefined' && partValue.length != 0) {
                partValue = JSON.parse(partValue);
                $partRepeater.setList(partValue);
            }
        }
    </script>
    <script>
        $(document).on('change', '.service_part_id', function () {
            var currentElement = $(this).closest('tr');
            var service_part_id = $(this).val();
            var url = '<?php echo e(route("estimation.service.part")); ?>';
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: service_part_id,
                },
                contentType: false,
                type: 'GET',
                success: function (data) {
                    currentElement.find('.quantity').val(1);
                    currentElement.find('.amount').val(data.price);
                    currentElement.find('.unit').html(data.unit);
                    currentElement.find('.description').val(data.description);
                },
            });
        });

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('estimation.index')); ?>"><?php echo e(__('Estimation')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(__('Edit')); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo e(Form::model($estimation, array('route' => array('estimation.update', \Illuminate\Support\Facades\Crypt::encrypt($estimation->id)), 'method' => 'PUT'))); ?>

    <div class="row">
        <div class="col-lg-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Estimate Details')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="info-group">
                        <div class="form-group">
                            <div class="form-group">
                                <?php echo e(Form::label('estimation_id',__('Estimation Number'),array('class'=>'form-label'))); ?>

                                <span class="text-danger">*</span>
                                <div class="input-group">
                                        <span class="input-group-text ">
                                          <?php echo e(estimationPrefix()); ?>

                                        </span>
                                    <?php echo e(Form::text('estimation_id',$estimation->estimation_id,array('class'=>'form-control','placeholder'=>__('Enter Estimation Number')))); ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <?php echo e(Form::label('title',__('Title'),array('class'=>'form-label'))); ?> <span
                                class="text-danger">*</span>
                            <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter title'),'required'=>'required'))); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('client', __('Client'),['class'=>'form-label'])); ?> <span class="text-danger">*</span>
                            <?php echo Form::select('client', $clients, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('asset', __('Asset'),['class'=>'form-label'])); ?> <span
                                class="text-danger">*</span>
                            <?php echo Form::select('asset', $assets, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('due_date',__('Due Date'),array('class'=>'form-label'))); ?> <span
                                class="text-danger">*</span>
                            <?php echo e(Form::date('due_date',null,array('class'=>'form-control','required'=>'required'))); ?>

                        </div>
                        <div class="form-group col-md-12">
                            <?php echo e(Form::label('notes',__('Notes'),array('class'=>'form-label'))); ?>

                            <?php echo e(Form::textarea('notes',null,array('class'=>'form-control','rows'=>2))); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9">
            <div class="row ">
                <div class="services">
                    <div class="card repeater" data-value='<?php echo json_encode($estimationServices); ?>'>
                        <div class="card-header">
                            <h4><?php echo e(__('Services')); ?></h4>
                            <a class="btn btn-primary btn-sm" href="#" data-repeater-create=""> <i
                                    class="fa fa-plus mr-5"></i><?php echo e(__('Add Service')); ?></a>
                        </div>
                        <div class="card-body">
                            <table class="display dataTable cell-border" data-repeater-list="services">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Service')); ?></th>
                                    <th><?php echo e(__('Quantity')); ?></th>
                                    <th><?php echo e(__('Unit')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Description')); ?></th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody data-repeater-item>
                                <tr>
                                    <?php echo e(Form::hidden('id',null,array('class'=>'form-control id'))); ?>

                                    <td width="30%">
                                        <?php echo e(Form::select('service_part_id',$services,null,array('class'=>'form-control hidesearch service_part_id'))); ?>

                                    </td>
                                    <td>
                                        <?php echo e(Form::number('quantity',null,array('class'=>'form-control quantity'))); ?>

                                    </td>
                                    <td>
                                        <div class="input-group unit">
                                            <?php echo e(Form::text('unit',null,array('class'=>'form-control','disabled'))); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <?php echo e(Form::number('amount',null,array('class'=>'form-control amount'))); ?>

                                    </td>
                                    <td>
                                        <?php echo e(Form::textarea('description',null,array('class'=>'form-control description','rows'=>1))); ?>

                                    </td>
                                    <td>
                                        <a class="text-danger" data-repeater-delete href="#"> <i
                                                data-feather="trash-2"></i></a>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="parts">
                    <div class="card repeater" data-value='<?php echo json_encode($estimationParts); ?>'>
                        <div class="card-header">
                            <h4><?php echo e(__('Parts')); ?></h4>
                            <a class="btn btn-primary btn-sm" href="#" data-repeater-create=""> <i
                                    class="fa fa-plus mr-5"></i><?php echo e(__('Add Part')); ?></a>
                        </div>
                        <div class="card-body">
                            <table class="display dataTable cell-border" data-repeater-list="parts">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Part')); ?></th>
                                    <th><?php echo e(__('Quantity')); ?></th>
                                    <th><?php echo e(__('Unit')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Description')); ?></th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody data-repeater-item>
                                <tr>
                                    <?php echo e(Form::hidden('id',null,array('class'=>'form-control id'))); ?>

                                    <td width="30%">
                                        <?php echo e(Form::select('service_part_id',$parts,null,array('class'=>'form-control hidesearch_part service_part_id'))); ?>

                                    </td>
                                    <td>
                                        <?php echo e(Form::number('quantity',null,array('class'=>'form-control quantity'))); ?>

                                    </td>
                                    <td>
                                        <div class="input-group unit">
                                            <?php echo e(Form::text('unit',null,array('class'=>'form-control','disabled'))); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <?php echo e(Form::number('amount',null,array('class'=>'form-control amount'))); ?>

                                    </td>
                                    <td>
                                        <?php echo e(Form::textarea('description',null,array('class'=>'form-control description','rows'=>1))); ?>

                                    </td>
                                    <td>
                                        <a class="text-danger" data-repeater-delete href="#"> <i
                                                data-feather="trash-2"></i></a>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" text-end">
                    <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary btn-rounded','id'=>'estimation-submit'))); ?>

                </div>
            </div>
        </div>

    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\thupsel\resources\views/estimation/edit.blade.php ENDPATH**/ ?>
@extends('layouts.app')
@section('page-title')
    {{__('Work Order')}}
@endsection
@push('script-page')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.repeater.min.js') }}"></script>
    <script>
        var serviceSelector = "body .services";
        if ($(serviceSelector + " .repeater").length) {
            var $serviceRepeater = $(serviceSelector + ' .repeater').repeater({
                initEmpty: true,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).find('.select2').select2();
                    // $('.hidesearch').select2({
                    //     minimumResultsForSearch: -1
                    // });
                    $(this).slideDown();
                },
                hide: function (deleteEstimation) {
                    if (confirm('Are you sure you want to delete this record?')) {
                        var id = $(this).find('.id').val();
                        $.ajax({
                            url: '{{route('workorder.service.part.destroy')}}',
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
                            url: '{{route('workorder.service.part.destroy')}}',
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
            var url = '{{ route("workorder.service.part") }}';
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
                    currentElement.find('.unit').val(data.unit);
                    currentElement.find('.description').val(data.description);
                },
            });
        });

    </script>
@endpush
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('workorder.index')}}">{{__('Work Order')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Edit')}}</a>
        </li>
    </ul>
@endsection

@section('content')
    {{ Form::model($workOrder, array('route' => array('workorder.update', \Illuminate\Support\Facades\Crypt::encrypt($workOrder->id)), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="info-group">
                        <div class="form-group">
                            <div class="form-group">
                                {{Form::label('wo_id',__('Workorder Number'),array('class'=>'form-label'))}}
                                <span class="text-danger">*</span>
                                <div class="input-group">
                                        <span class="input-group-text ">
                                          {{workOrderPrefix()}}
                                        </span>
                                    {{Form::text('wo_id',$workOrder->wo_id,array('class'=>'form-control','placeholder'=>__('Enter Workorder Number')))}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('client', __('Client Name'),['class'=>'form-label']) }} <span class="text-danger">*</span>
                            {!! Form::select('client', $clients, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
                        </div>
                        <div class="form-group">
                            {{Form::label('due_date',__('Due Date'),array('class'=>'form-label')) }} <span
                                class="text-danger">*</span>
                            {{Form::date('due_date',null,array('class'=>'form-control','required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-12">
                            {{Form::label('notes',__('Notes'),array('class'=>'form-label')) }}
                            {{Form::textarea('notes',null,array('class'=>'form-control','rows'=>1))}}
                        </div>
                        <div class="form-group">
                            {{Form::label('preferred_date',__('Preferred Date'),array('class'=>'form-label')) }}
                            {{Form::date('preferred_date',null,array('class'=>'form-control'))}}
                        </div>
                        <div class="form-group">
                            {{Form::label('wo_detail',__('WO Detail'),array('class'=>'form-label')) }} <span
                                class="text-danger">*</span>
                            {{Form::textarea('wo_detail',null,array('class'=>'form-control','rows'=>1,'required'=>'required'))}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('type', __('Type'),['class'=>'form-label']) }} <span
                                class="text-danger">*</span>
                            {!! Form::select('type', $woTypes, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('asset', __('Asset'),['class'=>'form-label']) }} <span
                                class="text-danger">*</span>
                            {!! Form::select('asset', $assets, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('priority', __('Priority'),['class'=>'form-label']) }} <span
                                class="text-danger">*</span>
                            {!! Form::select('priority', $priority, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('assign', __('Assign'),['class'=>'form-label']) }} <span class="text-danger">*</span>
                            {!! Form::select('assign', $users, null,array('class' => 'form-control hidesearch')) !!}
                        </div>
                        <hr>
                        <div class="form-group">
                            {{ Form::label('preferred_time', __('Preferred Time'),['class'=>'form-label']) }}
                            {!! Form::select('preferred_time', $time, null,array('class' => 'form-control hidesearch')) !!}
                        </div>
                        <div class="form-group ">
                            {{Form::label('preferred_note',__('Preference Note'),array('class'=>'form-label')) }}
                            {{Form::textarea('preferred_note',null,array('class'=>'form-control','rows'=>1))}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9">
            <div class="row ">
                <div class="services">
                    <div class="card repeater " data-value='{!! json_encode($workOrderServices) !!}'>
                        <div class="card-header">
                            <h4>{{__('Services')}}</h4>
                            <a class="btn btn-primary btn-sm" href="#" data-repeater-create=""> <i class="fa fa-plus mr-5"></i>{{__('Add Service')}}</a>
                        </div>
                        <div class="card-body">
                            <table class="display dataTable cell-border" data-repeater-list="services">
                                <thead>
                                    <tr>
                                        <th>{{__('Service')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Unit')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Description')}}</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody data-repeater-item>
                                    <tr>
                                        {{Form::hidden('id',null,array('class'=>'form-control id'))}}
                                        <td width="30%">
                                            {{Form::select('service_part_id',$services,null,array('class'=>'form-control hidesearch service_part_id select2'))}}
                                        </td>
                                        <td>
                                            {{Form::number('quantity',null,array('class'=>'form-control quantity'))}}
                                        </td>
                                        <td>
                                            {{Form::text('unit',null,array('class'=>'form-control unit', 'readonly'=>'readonly'))}}
                                        </td>
                                        <td>
                                            {{Form::number('amount',null,array('class'=>'form-control amount'))}}
                                        </td>
                                        <td>
                                            {{Form::textarea('description',null,array('class'=>'form-control description','rows'=>1))}}
                                        </td>
                                        <td>
                                            <a class="text-danger" data-repeater-delete href="#"> <i data-feather="trash-2"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="parts">
                    <div class="card repeater parts" data-value='{!! json_encode($workOrderParts) !!}'>
                        <div class="card-header">
                            <h4>{{__('Parts')}}</h4>
                            <a class="btn btn-primary btn-sm" href="#" data-repeater-create=""> <i class="fa fa-plus mr-5"></i>{{__('Add Part')}}</a>
                        </div>
                        <div class="card-body">
                            <table class="display dataTable cell-border" data-repeater-list="parts">
                                <thead>
                                    <tr>
                                        <th>{{__('Part')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Unit')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Description')}}</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody data-repeater-item>
                                    <tr>
                                        {{Form::hidden('id',null,array('class'=>'form-control id'))}}
                                        <td width="30%">
                                            {{Form::select('service_part_id',$parts,null,array('class'=>'form-control hidesearch_part service_part_id'))}}
                                        </td>
                                        <td>
                                            {{Form::number('quantity',null,array('class'=>'form-control quantity'))}}
                                        </td>
                                        <td>
                                            {{Form::text('unit',null,array('class'=>'form-control unit', 'readonly'=>'readonly'))}}
                                        </td>
                                        <td>
                                            {{Form::number('amount',null,array('class'=>'form-control amount'))}}
                                        </td>
                                        <td>
                                            {{Form::textarea('description',null,array('class'=>'form-control description','rows'=>1))}}
                                        </td>
                                        <td>
                                            <a class="text-danger" data-repeater-delete href="#"> <i data-feather="trash-2"></i></a>
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
                    {{Form::submit(__('Update'),array('class'=>'btn btn-primary btn-rounded'))}}
                </div>
            </div>
        </div>
    </div>
    {{Form::close()}}
@endsection

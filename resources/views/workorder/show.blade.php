@extends('layouts.app')
@section('page-title')
    {{__('Workorder')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('workorder.index')}}">{{__('Workorder')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{workOrderPrefix().$workorder->wo_id}}</a>
        </li>
    </ul>
@endsection
@php
    $admin_logo=getSettingsValByName('company_logo');
    $settings=settings();
@endphp
@push('script-page')
    <script>
        $(document).on('click', '.print', function () {
            var printContents = document.getElementById('invoice-print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            $('.invoice-action').addClass('d-none');
            window.print();
            $('.invoice-action').removeClass('d-none');
            document.body.innerHTML = originalContents;
        });

        $(document).on('click', '.workorderStatusChange', function () {
            var workorderStatus = this.value;
            var workorderUrl = $(this).data('url');
            $.ajax({
                url: workorderUrl + '?status=' + workorderStatus,
                type: 'GET',
                cache: false,
                success: function (data) {
                    location.reload();
                },
            });
        });
    </script>
@endpush

@section('card-action-btn')

    <a class="btn btn-warning print " href="javascript:void(0);"> {{__('Print')}}</a>
@endsection
@section('content')

    <div class="col-sm-12 product-detail-page wo_detail">
        <div class="product-card product-detail-tab">
            <ul class="nav nav-tabs">
                <li>
                    <a class="btn {{empty(session('active_tab'))?'active':''}}" data-bs-toggle="tab"
                       href="#service_part">{{__('Services and Parts')}} </a>
                </li>
                <li>
                    <a class="btn {{session('active_tab')=='service_task'?'active show':''}}" data-bs-toggle="tab"
                       href="#service_task">{{__('Service Tasks')}} </a>
                </li>
                <li>
                    <a class="btn {{session('active_tab')=='service_appointment'?'active show':''}}"
                       data-bs-toggle="tab" href="#service_appointment">{{__('Service Appointment')}} </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade  {{empty(session('active_tab'))?'active show':''}}" id="service_part">
                    <div id="invoice-print">
                        <div class="card-body cdx-invoice">
                            <div id="cdx-invoice">
                                <div class="head-invoice">
                                    <div class="codex-brand">
                                        <a class="codexbrand-logo" href="Javascript:void(0);">
                                            <img class="img-fluid invoice-logo"
                                                 src=" {{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                                                 alt="invoice-logo">
                                        </a>
                                        <a class="codexdark-logo" href="Javascript:void(0);">
                                            <img class="img-fluid invoice-logo"
                                                 src=" {{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                                                 alt="invoice-logo">
                                        </a>
                                    </div>
                                    <ul class="contact-list">

                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-user"></i>
                                            </div>{{$settings['company_name']}}
                                        </li>
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-phone"></i>
                                            </div>{{$settings['company_phone']}}
                                        </li>
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-envelope"></i>
                                            </div>{{$settings['company_email']}}
                                        </li>

                                    </ul>
                                </div>
                                <div class="invoice-user">
                                    <div class="left-user">
                                        <h5>{{__('Client')}}:</h5>
                                        <ul class="detail-list">
                                            <li>
                                                <div class="icon-wrap"><i class="fa fa-user"></i></div>
                                                {{ !empty($workorder->clients)?$workorder->clients->name:''}}
                                                ({{!empty($workorder->clients) && !empty($workorder->clients->clients)?$workorder->clients->clients->company:''}}
                                                )
                                            </li>
                                            <li>
                                                <div class="icon-wrap"><i class="fa fa-phone"></i>
                                                </div>{{ !empty($workorder->clients)?$workorder->clients->phone_number:''}}
                                            </li>
                                        </ul>

                                        <h6 class="mt-10 text-primary">{{__('Service Address')}}:</h6>
                                        <ul class="detail-list">
                                            <li>
                                                <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                                                {{!empty($workorder->clients) && !empty($workorder->clients->clients)?$workorder->clients->clients->service_address:''}}
                                                @if(!empty($workorder->clients) && !empty($workorder->clients->clients) && !empty($workorder->clients->clients->service_city))
                                                    <br>  {{$workorder->clients->clients->service_city}}
                                                    ,  {{$workorder->clients->clients->service_state}}
                                                    , {{$workorder->clients->clients->service_country}},
                                                    {{$workorder->clients->clients->service_zip_code}}
                                                @endif

                                            </li>
                                        </ul>

                                        <h6 class="mt-10 text-primary">{{__('Billing Address')}}:</h6>
                                        <ul class="detail-list">
                                            <li>
                                                <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                                                {{!empty($workorder->clients) && !empty($workorder->clients->clients)?$workorder->clients->clients->billing_address:''}}
                                                @if(!empty($workorder->clients) && !empty($workorder->clients->clients) && !empty($workorder->clients->clients->billing_city))
                                                    <br>  {{$workorder->clients->clients->billing_city}}
                                                    ,  {{$workorder->clients->clients->billing_state}}
                                                    , {{$workorder->clients->clients->billing_country}},
                                                    {{$workorder->clients->clients->billing_zip_code}}
                                                @endif

                                            </li>
                                        </ul>


                                    </div>

                                    <div class="right-user">
                                        <ul class="detail-list">
                                            <li>{{__('Workorder No')}}:
                                                <span>{{workOrderPrefix().$workorder->wo_id}} </span></li>
                                            <li>{{__('Assign To')}}:
                                                <span> {{!empty($workorder->assigned)?$workorder->assigned->name:'-' }}  </span>
                                            </li>
                                            <li>{{__('Asset')}}:
                                                <span>{{ !empty($workorder->assets)?$workorder->assets->name:'-' }} </span>
                                            </li>
                                            <li>{{__('Due Date')}}:
                                                <span> {{dateFormat($workorder->due_date)}} </span>
                                            </li>
                                            <li>{{__('Type')}}:
                                                <span>{{ !empty($workorder->types)?$workorder->types->type:'-' }} </span>
                                            </li>

                                            <li>{{__('Status')}}:
                                                @if($workorder->status=='pending')
                                                    <span
                                                        class="badge badge-warning">{{\App\Models\Workorder::$status[$workorder->status] }}</span>
                                                @elseif($workorder->status=='on_hold')
                                                    <span
                                                        class="badge badge-primary">{{\App\Models\Workorder::$status[$workorder->status] }}</span>
                                                @elseif($workorder->status=='approved' || $workorder->status=='completed')
                                                    <span
                                                        class="badge badge-success">{{\App\Models\Workorder::$status[$workorder->status] }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-danger">{{\App\Models\Workorder::$status[$workorder->status] }}</span>
                                                @endif

                                            </li>
                                            <li class="mt-5">{{__('Priority')}}:
                                                @if($workorder->priority=='low')
                                                    <span
                                                        class="badge badge-primary">{{\App\Models\WORequest::$priority[$workorder->priority] }}</span>
                                                @elseif($workorder->priority=='medium')
                                                    <span
                                                        class="badge badge-info">{{\App\Models\WORequest::$priority[$workorder->priority] }}</span>
                                                @elseif($workorder->priority=='high')
                                                    <span
                                                        class="badge badge-warning">{{\App\Models\WORequest::$priority[$workorder->priority] }}</span>
                                                @elseif($workorder->priority=='critical')
                                                    <span
                                                        class="badge badge-danger">{{\App\Models\WORequest::$priority[$workorder->priority] }}</span>
                                                @endif

                                            </li>


                                        </ul>
                                    </div>
                                </div>

                                <div class="body-invoice">
                                    <div class="table-responsive1">
                                        <table class="table ml-1">
                                            <thead>
                                            <tr>
                                                <th>{{__('Service')}}</th>
                                                <th>{{__('Quantity')}}</th>
                                                <th>{{__('Description')}}</th>
                                                <th>{{__('Amount')}}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($workorder->services as $service)
                                                <tr>
                                                    <td>{{!empty($service->serviceParts)?$service->serviceParts->title:'-'}}</td>
                                                    <td>{{$service->quantity}} {{!empty($service->serviceParts)?$service->serviceParts->unit:''}}</td>
                                                    <td>{{!empty($service->description)?$service->description:'-'}}</td>
                                                    <td>{{priceFormat($service->amount)}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="body-invoice">
                                    <div class="table-responsive1">
                                        <table class="table ml-1">
                                            <thead>
                                            <tr>
                                                <th>{{__('Part')}}</th>
                                                <th>{{__('Quantity')}}</th>
                                                <th>{{__('Description')}}</th>
                                                <th>{{__('Amount')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($workorder->parts as $part)
                                                <tr>
                                                    <td>
                                                        {{!empty($part->serviceParts)?$part->serviceParts->title:'-'}}
                                                    </td>
                                                    <td>{{$part->quantity}} {{!empty($part->serviceParts)?$part->serviceParts->unit:''}}</td>
                                                    <td>{{!empty($part->description)?$part->description:'-'}}</td>
                                                    <td>{{priceFormat($part->amount)}}</td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="footer-invoice">
                                    <table class="table">
                                        <tr>
                                            <td>{{__('Grand Total')}}</td>
                                            <td>{{priceFormat($workorder->getWorkorderTotalAmount())}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @if(!empty($workorder->notes))
                                            {{__('Notes')}} : <p>{{$workorder->notes}}</p>
                                        @endif
                                    </div>

                                </div>
                                @if(Gate::check('estimation status change'))
                                    <div class="invoice-action">
                                        <div class="small-group">
                                            @foreach($status as $k=>$val)
                                                <div>
                                                    <div class="chek-group">
                                            <span class="custom-check-input custom-chek">
                                            <input class="form-check-input workorderStatusChange" type="radio"
                                                   value="{{$k}}"
                                                   {{($workorder->status==$k)?'checked':''}} id="{{$val}}"
                                                   data-url="{{route('workorder.status',$workorder->id)}}"
                                                   name="status"></span>
                                                        <label class="ml-5" for="{{$val}}">{{$val}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade  {{session('active_tab')=='service_task'?'active show':''}}"
                     id="service_task">
                    <div class=" project-summarytbl">
                        <div class="card-header text-end">
                            @if(Gate::check('create workorder service task'))
                                <a class="btn btn-primary btn-sm me-2 customModal float-right" href="#"
                                   data-url="{{ route('workorder.service.task.create',$workorder->id) }}" data-size="md"
                                   data-title="{{__('Create Service Task')}}"> <i class="ti-plus mr-5"></i>
                                    {{__('Create Task')}}
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__('Service')}}</th>
                                        <th>{{__('Service Task')}}</th>
                                        <th>{{__('Task Duration')}}</th>
                                        <th>{{__('Description')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($workorder->tasks as $task)
                                        <tr>
                                            <td>{{!empty($task->services)?$task->services->title:'-'}}</td>
                                            <td>{{$task->service_task}}</td>
                                            <td>{{$task->duration}}</td>
                                            <td>{{$task->description}}</td>
                                            <td>
                                                @if($task->status=='pending')
                                                    <span
                                                        class="badge badge-warning">{{\App\Models\WOServiceTask::$status[$task->status]}}</span>
                                                @elseif($task->status=='in_progress')
                                                    <span
                                                        class="badge badge-primary">{{\App\Models\WOServiceTask::$status[$task->status]}}</span>
                                                @elseif($task->status=='on_hold')
                                                    <span
                                                        class="badge badge-danger">{{\App\Models\WOServiceTask::$status[$task->status]}}</span>
                                                @elseif($task->status=='completed')
                                                    <span
                                                        class="badge badge-success">{{\App\Models\WOServiceTask::$status[$task->status]}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="cart-action">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['workorder.service.task.destroy', $workorder->id,$task->id]]) !!}

                                                    @can('edit workorder service task')
                                                        <a class="text-success customModal" data-bs-toggle="tooltip"
                                                           data-size="md"
                                                           data-bs-original-title="{{__('Edit')}}" href="#"
                                                           data-url="{{ route('workorder.service.task.edit',[$workorder->id,$task->id]) }}"
                                                           data-title="{{__('Edit Task')}}"> <i data-feather="edit"></i></a>
                                                    @endcan
                                                    @can('delete workorder service task')
                                                        <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                           data-bs-original-title="{{__('Detete')}}" href="#"> <i
                                                                data-feather="trash-2"></i></a>
                                                    @endcan
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade  {{session('active_tab')=='service_appointment'?'active show':''}}"
                     id="service_appointment">
                    <div class=" project-summarytbl">
                        <div class="card-header text-end">
                            @if(Gate::check('create service appointment'))
                                <a class="btn btn-primary btn-sm me-2 customModal float-right" href="#"
                                   data-url="{{ route('workorder.service.appointment',$workorder->id) }}" data-size="md"
                                   data-title="{{__('Service Appointment')}}">
                                    {{__('Service Appointment')}}
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__('Start Date')}}</th>
                                        <th>{{__('Start Time')}}</th>
                                        <th>{{__('End Date')}}</th>
                                        <th>{{__('End Time')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Description')}}</th>
                                        <th>#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $appointment=$workorder->appointments; @endphp
                                    @if(!empty($appointment))
                                        <tr>
                                            <td>{{dateFormat($appointment->start_date)}}</td>
                                            <td>{{timeFormat($appointment->start_time)}}</td>
                                            <td>{{dateFormat($appointment->end_date)}}</td>
                                            <td>{{timeFormat($appointment->end_time)}}</td>

                                            <td>
                                                @if(in_array($appointment->status,['pending','on_hold']))
                                                    <span
                                                        class="badge badge-warning">{{\App\Models\WOServiceAppointment::$status[$appointment->status]}}</span>
                                                @elseif(in_array($appointment->status,['schedule','reschedule']))
                                                    <span
                                                        class="badge badge-primary">{{\App\Models\WOServiceAppointment::$status[$appointment->status]}}</span>
                                                @elseif($appointment->status=='dispatched')
                                                    <span
                                                        class="badge badge-info">{{\App\Models\WOServiceAppointment::$status[$appointment->status]}}</span>
                                                @elseif($appointment->status=='completed')
                                                    <span
                                                        class="badge badge-success">{{\App\Models\WOServiceAppointment::$status[$appointment->status]}}</span>
                                                @else
                                                    <span
                                                        class="badge badge-danger">{{\App\Models\WOServiceAppointment::$status[$appointment->status]}}</span>
                                                @endif
                                            </td>
                                            <td>{{$appointment->notes}}</td>
                                            <td>
                                                <div class="cart-action">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['workorder.service.appointment.destroy', $workorder->id]]) !!}
                                                    @can('delete service appointment')
                                                        <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                           data-bs-original-title="{{__('Detete')}}" href="#"> <i
                                                                data-feather="trash-2"></i></a>
                                                    @endcan
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

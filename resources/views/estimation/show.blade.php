@extends('layouts.app')
@section('page-title')
    {{__('Estimation')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('estimation.index')}}">{{__('Estimation')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{estimationPrefix().$estimation->estimation_id}}</a>
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

        $(document).on('click', '.estimationStatusChange', function () {
            var estimationStatus = this.value;
            var estimationUrl = $(this).data('url');
            $.ajax({
                url: estimationUrl + '?status=' + estimationStatus,
                type: 'GET',
                cache: false,
                success: function (data) {
                    location.reload();
                },
            });
        });
    </script>

@endpush
@section('content')
    <div class="row mb-10">
        <div class="invoice-action ">
            <a class="btn btn-warning float-end print" href="javascript:void(0);"> {{__('Print')}}</a>
        </div>
    </div>
    <div id="invoice-print">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                                            {{ !empty($estimation->clients)?$estimation->clients->name:''}}
                                            ({{!empty($estimation->clients) && !empty($estimation->clients->clients)?$estimation->clients->clients->company:''}}
                                            )
                                        </li>
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-phone"></i>
                                            </div>{{ !empty($estimation->clients)?$estimation->clients->phone_number:''}}
                                        </li>
                                    </ul>

                                    <h6 class="mt-10 text-primary">{{__('Service Address')}}:</h6>
                                    <ul class="detail-list">
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                                            {{!empty($estimation->clients) && !empty($estimation->clients->clients)?$estimation->clients->clients->service_address:''}}
                                            @if(!empty($estimation->clients) && !empty($estimation->clients->clients) && !empty($estimation->clients->clients->service_city))
                                                <br>  {{$estimation->clients->clients->service_city}}
                                                ,  {{$estimation->clients->clients->service_state}}
                                                , {{$estimation->clients->clients->service_country}},
                                                {{$estimation->clients->clients->service_zip_code}}
                                            @endif

                                        </li>
                                    </ul>

                                    <h6 class="mt-10 text-primary">{{__('Billing Address')}}:</h6>
                                    <ul class="detail-list">
                                        <li>
                                            <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                                            {{!empty($estimation->clients) && !empty($estimation->clients->clients)?$estimation->clients->clients->billing_address:''}}
                                            @if(!empty($estimation->clients) && !empty($estimation->clients->clients) && !empty($estimation->clients->clients->billing_city))
                                                <br>  {{$estimation->clients->clients->billing_city}}
                                                ,  {{$estimation->clients->clients->billing_state}}
                                                , {{$estimation->clients->clients->billing_country}},
                                                {{$estimation->clients->clients->billing_zip_code}}
                                            @endif

                                        </li>
                                    </ul>


                                </div>

                                <div class="right-user">
                                    <ul class="detail-list">
                                        <li>{{__('Estimation No')}}:
                                            <span>{{estimationPrefix().$estimation->estimation_id}} </span></li>
                                        <li>{{__('Asset')}}:
                                            <span>{{ !empty($estimation->assets)?$estimation->assets->name:'-' }} </span>
                                        </li>
                                        <li>{{__('Due Date')}}:
                                            <span> {{dateFormat($estimation->due_date)}} </span>
                                        </li>
                                        <li>{{__('Status')}}:
                                            @if($estimation->status=='pending')
                                                <span
                                                    class="badge badge-warning">{{\App\Models\Estimation::$status[$estimation->status] }}</span>
                                            @elseif($estimation->status=='on_hold')
                                                <span
                                                    class="badge badge-primary">{{\App\Models\Estimation::$status[$estimation->status] }}</span>
                                            @elseif($estimation->status=='approved' || $estimation->status=='completed')
                                                <span
                                                    class="badge badge-success">{{\App\Models\Estimation::$status[$estimation->status] }}</span>
                                            @else
                                                <span
                                                    class="badge badge-danger">{{\App\Models\Estimation::$status[$estimation->status] }}</span>
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
                                        @foreach($estimation->services as $service)
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
                                        @foreach($estimation->parts as $part)
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
                                        <td>{{priceFormat($estimation->getEstimationSubTotalAmount())}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    @if(!empty($estimation->notes))
                                        {{__('Notes')}} : <p>{{$estimation->notes}}</p>
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
                                            <input class="form-check-input estimationStatusChange" type="radio" value="{{$k}}"
                                                   {{($estimation->status==$k)?'checked':''}} id="{{$val}}"
                                                   data-url="{{route('estimation.status',$estimation->id)}}"
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
        </div>

    </div>
@endsection

@extends('layouts.app')
@section('page-title')
    {{__('Invoice')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('invoice.index')}}">{{__('Invoice')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{invoicePrefix().$invoice->invoice_id}}</a>
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

    </script>
@endpush

@section('card-action-btn')
    <a class="btn btn-warning print me-2" href="javascript:void(0);"> {{__('Print')}}</a>
    @can('edit invoice')
        <a class="btn btn-primary customModal"  data-size="lg"
         href="#"
           data-url="{{ route('invoice.edit',$invoice->id) }}"
           data-title="{{__('Edit Invoice')}}">  {{__('Edit')}}</a>
    @endcan

@endsection
@section('content')
    <div id="invoice-print">
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
                                <li>
                                    {{__('Invoice No')}}:
                                    <span>{{invoicePrefix().$invoice->invoice_id}} </span>
                                </li>
                                <li>
                                    {{__('Work Order No')}}:
                                    <span>{{workOrderPrefix().$workorder->wo_id}} </span>
                                </li>

                                <li>
                                    {{__('Invoice Date')}}:
                                    <span> {{dateFormat($invoice->invoice_date)}} </span>
                                </li>
                                <li>
                                    {{__('Due Date')}}:
                                    <span> {{dateFormat($invoice->due_date)}} </span>
                                </li>


                                <li>{{__('Status')}}:
                                    @if($invoice->status=='paid')
                                        <span
                                            class="badge badge-success">{{\App\Models\Invoice::$status[$invoice->status] }}</span>
                                    @else
                                        <span
                                            class="badge badge-danger">{{\App\Models\Invoice::$status[$invoice->status] }}</span>
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
                                <td>{{__('Sub Total')}}</td>
                                <td>{{priceFormat($workorder->getWorkorderTotalAmount())}}</td>
                            </tr>
                            @if($invoice->discount>0)
                            <tr>
                                <td>{{__('Discount')}}</td>
                                <td>{{priceFormat($invoice->discount)}}</td>
                            </tr>
                            @endif
                            <tr>
                                <td>{{__('Grand Total')}}</td>
                                <td>{{priceFormat($invoice->total-$invoice->discount)}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if(!empty($invoice->notes))
                                {{__('Notes')}} : <p>{{$invoice->notes}}</p>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

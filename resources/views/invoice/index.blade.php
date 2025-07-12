@extends('layouts.app')
@section('page-title')
    {{__('Invoice')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Invoice')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create invoice'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('invoice.create') }}"
           data-title="{{__('Create Invoice')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Invoice')}}
        </a>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Client')}}</th>
                            <th>{{__('Workorder')}}</th>
                            <th>{{__('Invoice Date')}}</th>
                            <th>{{__('Due Date')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Total')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td><a href="{{route('invoice.show',\Illuminate\Support\Facades\Crypt::encrypt($invoice->id))}}">{{ invoicePrefix().$invoice->invoice_id }}</a> </td>
                                <td>{{ !empty($invoice->clients)?$invoice->clients->name:'-' }} </td>
                                <td><a href="{{route('workorder.show',\Illuminate\Support\Facades\Crypt::encrypt($invoice->wo_id))}}">{{ workOrderPrefix() }}{{!empty($invoice->workorders)?$invoice->workorders->wo_id:''}}</a></td>
                                <td>{{ dateFormat($invoice->invoice_date) }} </td>
                                <td>{{ dateFormat($invoice->due_date) }} </td>
                                <td>
                                    @if($invoice->status=='paid')
                                        <span
                                            class="badge badge-success">{{\App\Models\Invoice::$status[$invoice->status] }}</span>
                                    @else
                                        <span
                                            class="badge badge-danger">{{\App\Models\Invoice::$status[$invoice->status] }}</span>
                                    @endif

                                </td>
                                <td>{{ priceFormat($invoice->total-$invoice->discount) }}  </td>
                                <td>
                                    <div class="cart-action">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['invoice.destroy', $invoice->id]]) !!}
                                        @can('show invoice')
                                            <a class="text-warning" data-bs-toggle="tooltip"
                                               data-bs-original-title="{{__('Details')}}" href="{{ route('invoice.show',\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)) }}"> <i data-feather="eye"></i></a>

                                        @endcan
                                        @can('edit invoice')
                                            <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="{{__('Edit')}}" href="#"
                                               data-url="{{ route('invoice.edit',$invoice->id) }}"
                                               data-title="{{__('Edit Invoice')}}"> <i data-feather="edit"></i></a>
                                        @endcan
                                        @can('delete invoice')
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
@endsection

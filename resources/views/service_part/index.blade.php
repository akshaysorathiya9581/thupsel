@extends('layouts.app')
@section('page-title')
    {{__('Inventory')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Inventory Items')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create service & part'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('services-parts.create') }}"
           data-title="{{__('Create Inventory Items')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Inventory Items')}}
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
                            <th>{{__('Title')}}</th>
                            <th>{{__('No of Qty')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Unit')}}</th>
                            <th>{{__('Type')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($serviceParts as $servicePart)
                            <tr>
                                <td>{{ $servicePart->title }} </td>
                                <td>{{ $servicePart->sku }} </td>
                                <td>{{ priceFormat($servicePart->price) }} </td>
                                <td>{{ $servicePart->unit }} </td>
                                <td>{{ ucfirst($servicePart->type) }} </td>
                                <td>{{ !empty($servicePart->description)?$servicePart->description:"-" }} </td>
                                <td>
                                    <div class="cart-action">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['services-parts.destroy', $servicePart->id]]) !!}
                                        @can('show service & part')
                                            <a class="text-warning customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="{{__('Details')}}" href="#"
                                               data-url="{{ route('services-parts.show',$servicePart->id) }}"
                                               data-title="{{__('Inventory Detail')}}"> <i data-feather="eye"></i></a>

                                        @endcan
                                        @can('edit service & part')
                                            <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="{{__('Edit')}}" href="#"
                                               data-url="{{ route('services-parts.edit',$servicePart->id) }}"
                                               data-title="{{__('Edit Inventory Items')}}"> <i data-feather="edit"></i></a>
                                        @endcan
                                        @can('delete service & part')
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

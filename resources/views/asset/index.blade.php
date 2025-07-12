@extends('layouts.app')
@section('page-title')
    {{__('Assets')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Assets')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create asset'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('asset.create') }}"
           data-title="{{__('Create Asset')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Asset')}}
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
                            <th>{{__('Name')}}</th>
                            <th>{{__('Asset Number')}}</th>
                            <th>{{__('Part')}}</th>
                            <th>{{__('Parent Asset')}}</th>
                            <th>{{__('GIAI')}}</th>
                            <th>{{__('Order')}}</th>
                            <th>{{__('Purchase')}}</th>
                            <th>{{__('Installation')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($assets as $asset)
                            <tr>
                                <td>{{ $asset->name }} </td>
                                <td>{{ $asset->asset_number }} </td>
                                <td>{{ !empty($asset->parts)?$asset->parts->title:'-' }} </td>
                                <td>{{ !empty($asset->parents)?$asset->parents->name:'-' }} </td>
                                <td>{{ $asset->giai }} </td>
                                <td>{{ dateFormat($asset->order_date) }} </td>
                                <td>{{ dateFormat($asset->purchase_date) }} </td>
                                <td>{{ dateFormat($asset->installation_date) }} </td>
                                <td>
                                    <div class="cart-action">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['asset.destroy', $asset->id]]) !!}
                                        @can('show asset')
                                            <a class="text-warning customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="{{__('Details')}}" href="#"
                                               data-url="{{ route('asset.show',$asset->id) }}"
                                               data-title="{{__('Asset Detail')}}"> <i data-feather="eye"></i></a>

                                        @endcan
                                        @can('edit asset')
                                            <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="{{__('Edit')}}" href="#"
                                               data-url="{{ route('asset.edit',$asset->id) }}"
                                               data-title="{{__('Edit Asset')}}"> <i data-feather="edit"></i></a>
                                        @endcan
                                        @can('delete asset')
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

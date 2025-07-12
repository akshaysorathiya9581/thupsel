@extends('layouts.app')
@section('page-title')
    {{__('Estimation')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Estimation')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create estimation'))
        <a class="btn btn-primary btn-sm ml-20" href="{{ route('estimation.create') }}" > <i
                class="ti-plus mr-5"></i>
            {{__('Create Estimation')}}
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
                            <th>{{__('Title')}}</th>
                            <th>{{__('Client')}}</th>
                            <th>{{__('Asset')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Due Date')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($estimations as $estimation)
                            <tr>
                                <td>{{ estimationPrefix().$estimation->estimation_id }} </td>
                                <td>{{$estimation->title }} </td>
                                <td>{{ !empty($estimation->clients)?$estimation->clients->name:'-' }} </td>
                                <td>{{ !empty($estimation->assets)?$estimation->assets->name:'-' }} </td>
                                <td>{{priceFormat($estimation->getEstimationSubTotalAmount())}} </td>
                                <td>{{ dateFormat($estimation->due_date) }} </td>
                                <td>
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

                                </td>

                                <td>
                                    <div class="cart-action">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['estimation.destroy', $estimation->id]]) !!}
                                        @can('show estimation')
                                            <a class="text-warning" data-bs-toggle="tooltip" href="{{ route('estimation.show',\Illuminate\Support\Facades\Crypt::encrypt($estimation->id)) }}"
                                               data-title="{{__('Estimation Detail')}}"> <i data-feather="eye"></i></a>

                                        @endcan
                                        @can('edit estimation')
                                            <a class="text-success" data-bs-toggle="tooltip"
                                               data-bs-original-title="{{__('Edit')}}" href="{{ route('estimation.edit',\Illuminate\Support\Facades\Crypt::encrypt($estimation->id)) }}"> <i data-feather="edit"></i></a>
                                        @endcan
                                        @can('delete estimation')
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

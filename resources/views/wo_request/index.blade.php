@extends('layouts.app')
@section('page-title')
    {{__('Work Order Request')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Work Order Request')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create wo request'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('wo-request.create') }}"
           data-title="{{__('Create WO Request')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create WO Request')}}
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
                            <th>{{__('Request')}}</th>
                            <th>{{__('Client')}}</th>
                            <th>{{__('Asset')}}</th>
                            <th>{{__('Due Date')}}</th>
                            <th>{{__('Priority')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Assign')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($woRequests as $woRequest)
                            <tr>
                                <td>{{ $woRequest->request_detail }} </td>
                                <td>{{ !empty($woRequest->clients)?$woRequest->clients->name:'-' }} </td>
                                <td>{{ !empty($woRequest->assets)?$woRequest->assets->name:'-' }} </td>
                                <td>{{ dateFormat($woRequest->due_date) }} </td>

                                <td>
                                    @if($woRequest->priority=='low')
                                        <span
                                            class="badge badge-primary">{{\App\Models\WORequest::$priority[$woRequest->priority] }}</span>
                                    @elseif($woRequest->priority=='medium')
                                        <span
                                            class="badge badge-info">{{\App\Models\WORequest::$priority[$woRequest->priority] }}</span>
                                    @elseif($woRequest->priority=='high')
                                        <span
                                            class="badge badge-warning">{{\App\Models\WORequest::$priority[$woRequest->priority] }}</span>
                                    @elseif($woRequest->priority=='critical')
                                        <span
                                            class="badge badge-danger">{{\App\Models\WORequest::$priority[$woRequest->priority] }}</span>
                                    @endif

                                </td>

                                <td>
                                    @if($woRequest->status=='pending')
                                        <span
                                            class="badge badge-warning">{{\App\Models\WORequest::$status[$woRequest->status] }}</span>
                                    @elseif($woRequest->status=='in_progress')
                                        <span
                                            class="badge badge-primary">{{\App\Models\WORequest::$status[$woRequest->status] }}</span>
                                    @elseif($woRequest->status=='completed')
                                        <span
                                            class="badge badge-success">{{\App\Models\WORequest::$status[$woRequest->status] }}</span>
                                    @elseif($woRequest->status=='cancel')
                                        <span
                                            class="badge badge-danger">{{\App\Models\WORequest::$status[$woRequest->status] }}</span>
                                    @endif

                                </td>
                                <td>{{!empty($woRequest->assigned)?$woRequest->assigned->name:'-' }} </td>
                                <td>
                                    <div class="cart-action">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['wo-request.destroy', $woRequest->id]]) !!}
                                        @can('show wo request')
                                            <a class="text-warning customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="{{__('Details')}}" href="#"
                                               data-url="{{ route('wo-request.show',$woRequest->id) }}"
                                               data-title="{{__('WO Request Detail')}}"> <i data-feather="eye"></i></a>

                                        @endcan
                                        @can('edit wo request')
                                            <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                                               data-bs-original-title="{{__('Edit')}}" href="#"
                                               data-url="{{ route('wo-request.edit',$woRequest->id) }}"
                                               data-title="{{__('Edit WO Request')}}"> <i data-feather="edit"></i></a>
                                        @endcan
                                        @can('delete wo request')
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

@extends('layouts.app')
@section('page-title')
    {{__('Parts Inventory')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Parts Inventory')}}</a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    <a class="btn btn-primary btn-sm ml-20 customModal" href="{{ route('parts.create') }}"> <i class="ti-plus mr-5"></i>{{__('Add New Part')}}</a>
@endsection
@section('content')
  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Buttons to trigger modals -->
                    <div class="d-flex justify-content-center gap-3 mt-4 mb-4">
                        <a class="btn btn-outline-primary customModal" href="#" data-size="md" data-url="{{ route('sites.create') }}" data-title="{{__('Add New Site')}}"> <i class="ti-plus mr-5"></i>{{__('Add New Site')}}</a>

                        <a class="btn btn-outline-success customModal" href="#" data-size="md" data-url="{{ route('teams.create') }}" data-title="{{__('Add New Team')}}"> <i class="ti-plus mr-5"></i>{{__('Add New Team')}}</a>

                        <a class="btn btn-outline-info customModal" href="#" data-size="md" data-url="{{ route('projects.create') }}" data-title="{{__('Add New Project')}}"> <i class="ti-plus mr-5"></i>{{__('Add New Project')}}</a>
                    </div>

                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                            <tr>
                                <th class="table-header rounded-tl-lg">Part Name</th>
                                <th class="table-header">Code</th>
                                <th class="table-header">Status</th>
                                <th class="table-header">Current Stock</th>
                                <th class="table-header rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parts as $part)
                                <tr class="table-row hover:bg-gray-50">
                                    <td class="table-cell font-medium text-gray-900">{{ $part->name }}</td>
                                    <td class="table-cell text-gray-700">{{ $part->code }}</td>
                                    <td class="table-cell text-gray-700">
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full
                                            @if($part->status == 'In Stock') bg-green-100 text-green-800
                                            @elseif($part->status == 'In Use') bg-blue-100 text-blue-800
                                            @elseif($part->status == 'Under Repair') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ $part->status }}
                                        </span>
                                    </td>
                                    <td class="table-cell text-gray-700">{{ $part->current_stock }} / {{ $part->total_quantity }}</td>
                                    <td class="table-cell">
                                        <a href="{{ route('parts.show', $part->id) }}" class="btn btn-primary btn-rounded">
                                            View Details
                                        </a>
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
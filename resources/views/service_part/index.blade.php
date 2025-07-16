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
                    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
                        <div>
                            {{-- 🔽 Category Filter Dropdown --}}
                            <select id="categoryFilter" class="form-control" style="min-width: 250px;">
                                <option value="">{{ __('Filter by Category') }}</option>
                                @foreach($category as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Table Buttons and Search box will come automatically on right --}}
                    </div>
                    {{-- 🔽 Table Search Box --}}
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('No of Qty')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Unit')}}</th>
                            <th>{{__('Type')}}</th>
                            <th>{{__('Image')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody id="servicePartsTableBody">
                            @include('service_part.service_parts_table_rows', ['serviceParts' => $serviceParts])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var services_parts_filter_by_category = "{{ route('services-parts.index') }}";
</script>
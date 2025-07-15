@extends('layouts.app')
@section('page-title')
    {{__('Edit Part')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Edit Part')}}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Part: {{ $part->name }}</h1>

        <form action="{{ route('parts.update', $part->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group col-md-12">
                <label for="name" class="form-label">Part Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $part->name) }}" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="code" class="form-label">Part Code:</label>
                <input type="text" name="code" id="code" value="{{ old('code', $part->code) }}" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="purchase_date" class="form-label">Purchase Date:</label>
                <input type="date" name="purchase_date" id="purchase_date" value="{{ old('purchase_date', $part->purchase_date) }}" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="supplier" class="form-label">Supplier:</label>
                <input type="text" name="supplier" id="supplier" value="{{ old('supplier', $part->supplier) }}" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="In Stock" {{ old('status', $part->status) == 'In Stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="In Use" {{ old('status', $part->status) == 'In Use' ? 'selected' : '' }}>In Use</option>
                    <option value="Under Repair" {{ old('status', $part->status) == 'Under Repair' ? 'selected' : '' }}>Under Repair</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="serial_number" class="form-label">Serial/Batch Number:</label>
                <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $part->serial_number) }}" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="total_quantity" class="form-label">Total Quantity:</label>
                <input type="number" name="total_quantity" id="total_quantity" value="{{ old('total_quantity', $part->total_quantity) }}" class="form-control" min="0" required>
            </div>
            <div class="form-group col-md-12">
                <label for="current_stock" class="form-label">Current Stock:</label>
                <input type="number" name="current_stock" id="current_stock" value="{{ old('current_stock', $part->current_stock) }}" class="form-control" min="0" required>
            </div>
            <div class="form-group col-md-12">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $part->description) }}</textarea>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary btn-rounded">Update Part</button>
                <a href="{{ route('parts.show', $part->id) }}" class="btn btn-secondary btn-rounded">Cancel</a>
            </div>
        </form>
    </div>
@endsection
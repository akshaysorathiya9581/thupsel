@extends('layouts.app')
@section('page-title')
    {{__('Add New Part')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Add New Part')}}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <form action="{{ route('parts.store') }}" method="POST">
            @csrf
            <div class="form-group col-md-12">
                <label for="name" class="form-label">Part Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="code" class="form-label">Part Code:</label>
                <input type="text" name="code" id="code" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="purchase_date" class="form-label">Purchase Date:</label>
                <input type="date" name="purchase_date" id="purchase_date" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="supplier" class="form-label">Supplier:</label>
                <input type="text" name="supplier" id="supplier" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="In Stock">In Stock</option>
                    <option value="In Use">In Use</option>
                    <option value="Under Repair">Under Repair</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="serial_number" class="form-label">Serial/Batch Number:</label>
                <input type="text" name="serial_number" id="serial_number" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="total_quantity" class="form-label">Total Quantity:</label>
                <input type="number" name="total_quantity" id="total_quantity" class="form-control" min="0" required>
            </div>
            <div class="form-group col-md-12">
                <label for="current_stock" class="form-label">Current Stock:</label>
                <input type="number" name="current_stock" id="current_stock" class="form-control" min="0" required>
            </div>
            <div class="form-group col-md-12">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" rows="4" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary btn-rounded">Add Part</button>
                <a href="{{ route('parts.index') }}" class="btn btn-secondary btn-rounded">Cancel</a>
            </div>
        </form>
    </div>   
@endsection
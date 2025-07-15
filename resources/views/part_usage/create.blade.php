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
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Record Usage for: {{ $part->name }}</h1>

        <form action="{{ route('parts.storeUsage', $part->id) }}" method="POST">
            @csrf
            <div class="form-group col-md-12">
                <label for="used_by_team_id" class="form-label">Used By Team:</label>
                <select name="used_by_team_id" id="used_by_team_id" class="form-control" required>
                    <option value="">Select Team</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ old('used_by_team_id') == $team->id ? 'selected' : '' }}>{{ $team->name }} ({{ $team->role }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="site_id" class="form-label">Site:</label>
                <select name="site_id" id="site_id" class="form-control" required>
                    <option value="">Select Site</option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}" {{ old('site_id') == $site->id ? 'selected' : '' }}>{{ $site->name }} ({{ $site->location }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="project_id" class="form-label">Project (Optional):</label>
                <select name="project_id" id="project_id" class="form-control">
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="date_used" class="form-label">Date & Time of Usage:</label>
                <input type="datetime-local" name="date_used" id="date_used" value="{{ old('date_used', \Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}" class="form-control" required>
            </div>
            <div class="md:col-span-2">
                <label for="purpose_note" class="form-label">Purpose/Note:</label>
                <textarea name="purpose_note" id="purpose_note" rows="3" class="form-control">{{ old('purpose_note') }}</textarea>
            </div>
            <div class="md:col-span-2 flex items-center">
                <input type="checkbox" name="returned" id="returned" value="1" {{ old('returned') ? 'checked' : '' }} class="mr-2 leading-tight">
                <label for="returned" class="text-gray-700 text-sm font-bold">Returned (Check if the part was returned immediately after use)</label>
            </div>
            <div class="form-group col-md-12">
                <label for="condition_after_use" class="form-label">Condition After Use (Optional):</label>
                <input type="text" name="condition_after_use" id="condition_after_use" value="{{ old('condition_after_use') }}" class="form-control">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="btn btn-primary btn-rounded">Record Usage</button>
                <a href="{{ route('parts.show', $part->id) }}" class="btn btn-secondary btn-rounded">Cancel</a>
            </div>
        </form>
    </div>
@endsection
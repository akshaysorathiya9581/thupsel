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

@section('content')
    <div class="card" style="padding: 20px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 fw-bolder text-dark">{{ $part->name }} Details</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('parts.edit', $part->id) }}" class="btn btn-secondary">Edit Part</a>
                <a href="{{ route('parts.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>

        <!-- Part Details Section -->
        <div class="mb-4 p-4 rounded shadow-sm">
            <h2 class="h4 fw-semibold text-dark mb-25">Part Information</h2>
            <div class="row g-3 text-muted">
                <div class="col-md-6"><strong>Part Code:</strong> {{ $part->code }}</div>
                <div class="col-md-6"><strong>Status:</strong>
                    <span class="badge rounded-pill
                        @if($part->status == 'In Stock') bg-success text-white
                        @elseif($part->status == 'In Use') bg-primary text-white
                        @elseif($part->status == 'Under Repair') bg-warning text-dark
                        @else bg-secondary text-white @endif">
                        {{ $part->status }}
                    </span>
                </div>
                <div class="col-md-6"><strong>Purchase Date:</strong> {{ $part->purchase_date ? \Carbon\Carbon::parse($part->purchase_date)->format('M d, Y') : 'N/A' }}</div>
                <div class="col-md-6"><strong>Supplier:</strong> {{ $part->supplier ?? 'N/A' }}</div>
                <div class="col-md-6"><strong>Serial/Batch Number:</strong> {{ $part->serial_number ?? 'N/A' }}</div>
                <div class="col-12"><strong>Description:</strong> {{ $part->description ?? 'No description provided.' }}</div>
            </div>
        </div>

        <!-- Inventory Usage Section -->
        <div class="mb-4 p-4 rounded shadow-sm">
            <h2 class="h4 fw-semibold text-dark mb-25">Inventory & Usage Overview</h2>
            <div class="row text-center g-3">
                <div class="col-6 col-md-3">
                    <div class="bg-primary-subtle p-3 rounded">
                        <p class="text-primary fs-16 fw-bold mb-0">{{ $part->current_stock }}</p>
                        <p class="text-primary fw-medium mb-0">In Stock</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="bg-success-subtle p-3 rounded">
                        <p class="text-success fs-16 fw-bold mb-0">{{ $totalUsedCount }}</p>
                        <p class="text-success fw-medium mb-0">Total Used</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="bg-info-subtle p-3 rounded">
                        <p class="text-info fs-16 fw-bold mb-0">{{ $part->total_quantity }}</p>
                        <p class="text-info fw-medium mb-0">Total Purchased</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="bg-danger-subtle p-3 rounded">
                        <p class="text-danger fs-16 fw-bold mb-0">{{ $inUse }}</p>
                        <p class="text-danger fw-medium mb-0">Currently In Use</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="bg-warning-subtle p-3 rounded">
                        <p class="text-warning fs-16 fw-bold mb-0">{{ $damaged }}</p>
                        <p class="text-warning fw-medium mb-0">Damaged</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="bg-secondary-subtle p-3 rounded">
                        <p class="text-secondary fs-16 fw-bold mb-0">{{ $lost }}</p>
                        <p class="text-secondary fw-medium mb-0">Lost</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assigned Parts Section -->
        <div class="mb-4 p-4 rounded shadow-sm">
            <h2 class="h4 fw-semibold text-dark mb-25">Currently Assigned To</h2>
            @if ($currentAssignments->isEmpty())
                <p class="text-muted fst-italic">This part is not currently assigned to any team/employee.</p>
            @else
                <div class="table-responsive rounded shadow-sm">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="">
                            <tr>
                                <th scope="col" class="text-muted">Name</th>
                                <th scope="col" class="text-muted">Role</th>
                                <th scope="col" class="text-muted">Assigned Site</th>
                                <th scope="col" class="text-muted">Assigned Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currentAssignments as $assignment)
                                <tr>
                                    <td class="align-middle">{{ $assignment->team->name ?? 'N/A' }}</td>
                                    <td class="align-middle">{{ $assignment->team->role ?? 'N/A' }}</td>
                                    <td class="align-middle">{{ $assignment->site->name ?? 'N/A' }}</td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($assignment->date_used)->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Client Usage History Section -->
        <div class="p-4 rounded shadow-sm">
            <h2 class="h4 fw-semibold mb-3">Client Usage History</h2>
            <div class="d-flex justify-content-end mb-25">
                <a href="{{ route('parts.createUsage', $part->id) }}" class="btn btn-primary">Record New Usage</a>
            </div>
            @if ($part->usageHistory->isEmpty())
                <p class="text-muted fst-italic">No usage history found for this part.</p>
            @else
                <div class="table-responsive rounded shadow-sm">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="">
                            <tr>
                                <th scope="col" class="text-muted">Date & Time</th>
                                <th scope="col" class="text-muted">Used By</th>
                                <th scope="col" class="text-muted">Site / Project</th>
                                <th scope="col" class="text-muted">Purpose/Note</th>
                                <th scope="col" class="text-muted">Returned</th>
                                <th scope="col" class="text-muted">Condition</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($part->usageHistory as $usage)
                                <tr>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($usage->date_used)->format('M d, Y H:i') }}</td>
                                    <td class="align-middle">{{ $usage->team->name ?? 'N/A' }}</td>
                                    <td class="align-middle">
                                        {{ $usage->site->name ?? 'N/A' }}
                                        @if($usage->project)
                                            <br><small class="text-muted">({{ $usage->project->name }})</small>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $usage->purpose_note ?? 'N/A' }}</td>
                                    <td class="align-middle">
                                        @if($usage->returned)
                                            <span class="text-success">&#10004; Yes</span>
                                        @else
                                            <span class="text-danger">&#10008; No</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $usage->condition_after_use ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
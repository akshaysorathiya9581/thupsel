<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="projectName" class="form-label fw-bold">Project Name:</label>
            <input type="text" class="form-control" id="projectName" name="name" required>
        </div>
        <div class="mb-3">
            <label for="projectSite" class="form-label fw-bold">Site:</label>
            <select class="form-select" id="projectSite" name="site_id" required>
                <option value="">Select a Site</option>
                @foreach($sites as $site)
                    <option value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-rounded">Save Project</button>
        <a href="{{ route('parts.index') }}" class="btn btn-secondary btn-rounded">Cancel</a>
    </div>
</form>
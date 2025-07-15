<form action="{{ route('sites.store') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="siteName" class="form-label fw-bold">Site Name:</label>
            <input type="text" class="form-control" id="siteName" name="name" required>
        </div>
        <div class="mb-3">
            <label for="siteLocation" class="form-label fw-bold">Location:</label>
            <input type="text" class="form-control" id="siteLocation" name="location">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-rounded">Save Site</button>
        <a href="{{ route('parts.index') }}" class="btn btn-secondary btn-rounded">Cancel</a>
    </div>
</form>
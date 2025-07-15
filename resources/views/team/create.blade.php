<form action="{{ route('teams.store') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="teamName" class="form-label fw-bold">Team Name:</label>
            <input type="text" class="form-control" id="teamName" name="name" required>
        </div>
        <div class="mb-3">
            <label for="teamRole" class="form-label fw-bold">Role:</label>
            <input type="text" class="form-control" id="teamRole" name="role">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Team</button>
    </div>
</form>
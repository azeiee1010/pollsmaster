<!-- Poll Create Modal -->
<div class="modal fade" id="createPollModal" tabindex="-1" aria-labelledby="createPollModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <form id="createPollForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPollModalLabel">Create New Poll</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Question -->
                    <div class="mb-3">
                        <label class="form-label">Question</label>
                        <input type="text" name="question" class="form-control" placeholder="Enter your poll question"
                            required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Options -->
                    <label class="form-label">Options</label>
                    <div id="optionsWrapper">
                        <div class="input-group mb-2">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 1" required>
                        </div>
                        <div class="input-group mb-2">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 2" required>
                        </div>
                    </div>
                    <button type="button" id="addOptionBtn" class="btn btn-sm btn-outline-primary mb-3">Add
                        Option</button>

                    <!-- Expires At -->
                    <div class="mb-3">
                        <label class="form-label">Expires At (optional)</label>
                        <input type="datetime-local" name="expires_at" class="form-control">
                    </div>

                    <div id="create-poll-error" class="text-danger small mt-2"></div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create Poll</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="commonToast" class="toast align-items-center border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body text-white" id="commonToastBody"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

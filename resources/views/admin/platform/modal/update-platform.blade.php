<div class="modal fade" id="updatePlatformModal" tabindex="-1" aria-labelledby="updatePlatformLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header bg-custom-dark">
                <h5 class="modal-title fw-bold" id="updatePlatformLabel">Add new platform</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/airdrop/platform/store" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="col-form-label">Title</label>
                        <input required name="title" type="text" class="form-control" id="title">
                    </div>

                    <div class="mb-3">
                        <label for="ColorInput" class="form-label">Color picker</label>
                        <input type="color" class="form-control form-control-color" id="ColorInput" value="#563d7c" name="color" title="Choose your color">
                    </div>
                
                    <div class="modal-footer border-0 p-0">
                        <button type="button" class="fw-bold  btn btn-danger" data-bs-dismiss="modal">Close</button>  
                        <button type="submit" class="fw-bold btn fw-bold bg-primary text-white">Add new</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
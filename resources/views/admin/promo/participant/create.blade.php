<div class="modal fade" id="addParticipantModal" tabindex="-1" aria-labelledby="addParticipantLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            
            <div class="modal-header bg-custom-dark">
                <h5 class="modal-title fw-bold" id="addParticipantLabel">Add Participant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/airdrop/promo/participant/store" method="post">
                    @csrf
                    <div class="mb-3">
                        <input readonly type="hidden" name="id" id="id">
                        
                        <div class="mb-3">
                            <label for="name">Name/Username</label>
                            <input required type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="k8_username">k8 username(optional)</label>
                            <input type="text" name="k8_username" id="k8_username" class="form-control">
                        </div>
                        <div class="mb-3 border rounded p-3">
                            Winner?
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input value="No" class="form-check-input" type="radio" name="winner" id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input value="Yes" class="form-check-input" type="radio" name="winner" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input value="Never" class="form-check-input" type="radio" name="winner" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Never
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
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

<script>
    var addParticipantModal = document.getElementById('addParticipantModal')
    addParticipantModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id')

    var modalBodyID = addParticipantModal.querySelector('.modal-body #id')

    modalBodyID.value = id

    });
</script>
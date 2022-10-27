<div class="modal fade" id="editParticipantModal" tabindex="-1" aria-labelledby="editParticipantLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            
            <div class="modal-header bg-custom-dark">
                <h5 class="modal-title fw-bold" id="editParticipantLabel">Edit Participant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/airdrop/promo/participant/update" method="post">
                    @csrf
                    <div class="mb-3">
                        <input readonly type="hidden" name="id" id="id">
                        <input readonly type="hidden" name="promo_id" id="promo_id">
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
                        <button type="submit" class="fw-bold btn fw-bold bg-primary text-white">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</div>

<script>
    var editParticipantModal = document.getElementById('editParticipantModal')
    editParticipantModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id')
    var promo_id = button.getAttribute('data-bs-promo_id')
    var name = button.getAttribute('data-bs-name')
    var email = button.getAttribute('data-bs-email')
    var k8_username = button.getAttribute('data-bs-k8_username')

    var modalBodyID = editParticipantModal.querySelector('.modal-body #id')
    var modalBodyPromoID = editParticipantModal.querySelector('.modal-body #promo_id')
    var modalBodyName = editParticipantModal.querySelector('.modal-body #name')
    var modalBodyEmail = editParticipantModal.querySelector('.modal-body #email')
    var modalBodyK8Username = editParticipantModal.querySelector('.modal-body #k8_username')


    modalBodyID.value = id
    modalBodyPromoID.value = promo_id
    modalBodyName.value = name
    modalBodyEmail.value = email
    modalBodyK8Username.value = k8_username

    });
</script>
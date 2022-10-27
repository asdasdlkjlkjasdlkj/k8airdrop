<div class="modal fade" id="editCodeModal" tabindex="-1" aria-labelledby="editCodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            
            <div class="modal-header bg-custom-dark">
                <h5 class="modal-title fw-bold" id="editCodeLabel">Edit Promo Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/airdrop/promo/promocode/update" method="post">
                    @csrf
                    
                    <div class="mb-3">
                        <input readonly type="hidden" name="id" id="id">
                       <input readonly type="hidden" name="promo_id" id="promo_id">
                        
                        <input required type="text" name="name" id="name" class="form-control">
                        
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
    var editCodeModal = document.getElementById('editCodeModal')
    editCodeModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id')
    var promo_id = button.getAttribute('data-bs-promo_id')
    var name = button.getAttribute('data-bs-name')

    var modalBodyID = editCodeModal.querySelector('.modal-body #id')
    var modalBodyPromoID = editCodeModal.querySelector('.modal-body #promo_id')
    var modalBodyName = editCodeModal.querySelector('.modal-body #name')

    modalBodyID.value = id
    modalBodyPromoID.value = promo_id
    modalBodyName.value = name

    });
</script>
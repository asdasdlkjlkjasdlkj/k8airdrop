<div class="modal fade" id="addCodeModal" tabindex="-1" aria-labelledby="addCodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            
            <div class="modal-header bg-custom-dark">
                <h5 class="modal-title fw-bold" id="addCodeLabel">Add Promo Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/airdrop/promo/promocode/store" method="post">
                    @csrf
                    
                    <div class="mb-3">
                        <input readonly type="hidden" name="id" id="id">
                        
                        <input required type="text" name="name" id="name" class="form-control">
                        
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
    var addCodeModal = document.getElementById('addCodeModal')
    addCodeModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id')
    var name = button.getAttribute('data-bs-name')

    var modalBodyID = addCodeModal.querySelector('.modal-body #id')
    var modalBodyName = addCodeModal.querySelector('.modal-body #name')

    modalBodyID.value = id
    modalBodyName.value = name

    });
</script>
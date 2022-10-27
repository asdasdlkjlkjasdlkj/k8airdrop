<div class="modal fade" id="winnerParticipantModal" tabindex="-1" aria-labelledby="winnerParticipantLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            
            <div class="modal-header bg-custom-dark">
                <h5 class="modal-title fw-bold" id="winnerParticipantLabel">Generated Winner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @foreach($generated_winners->participants as $participant)
                    @if($participant->count() == 0)
                        No valid particpants
                    @else
                        <form action="/admin/airdrop/promo/participant/winner" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="promo_id" id="promo_id">
                                <div class="mb-3 text-center">
                                    <label for="name">Congratulations!</label>
                                    <input readonly required type="text" name="name" id="name" class="form-control text-center border-0" style="font-size:40px">
                                </div>
                            </div>
                        
                            <div class="modal-footer justify-content-center border-0 p-0 ">
                                <button type="submit" class="text-center fw-bold btn fw-bold bg-primary text-white">Save winner</button>
                            </div>
                        </form>
                    @endif
                @endforeach
                
            </div>
        </div>
    </div>  
</div>

<script>
    var winnerParticipantModal = document.getElementById('winnerParticipantModal')
    winnerParticipantModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id')
    var promo_id = button.getAttribute('data-bs-promo_id')
    var name = button.getAttribute('data-bs-name')

    var modalBodyID = winnerParticipantModal.querySelector('.modal-body #id')
    var modalBodyPromoID = winnerParticipantModal.querySelector('.modal-body #promo_id')
    var modalBodyName = winnerParticipantModal.querySelector('.modal-body #name')

    modalBodyID.value = id
    modalBodyPromoID.value = promo_id
    modalBodyName.value = name

    });
</script>
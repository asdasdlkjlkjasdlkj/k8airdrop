<div class="modal fade" id="removePlatformModal" tabindex="-1" aria-labelledby="removePlatfomLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            
            <div class="modal-header bg-custom-dark">
                <h5 class="modal-title fw-bold" id="removePlatfomLabel">Remove platform</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/users/remove_platform" method="post">
                    @csrf
                    
                    <div class="mb-3">
                        <input readonly type="hidden" name="id" id="id">

                        <select name="platform" id="platform" class="form-control">
                            @foreach($users_pivot as $user_platform)
                                @foreach($user_platform->platforms as $platform)
                                    <option value="{{$platform->id}}">{{$platform->title}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                
                    <div class="modal-footer border-0 p-0">
                        <button type="button" class="fw-bold  btn btn-danger" data-bs-dismiss="modal">Close</button>  
                        <button type="submit" class="fw-bold btn fw-bold bg-primary text-white">Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    var removePlatformModal = document.getElementById('removePlatformModal')
    removePlatformModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id')

    var modalBodyID = removePlatformModal.querySelector('.modal-body #id')

    modalBodyID.value = id

    });

</script>
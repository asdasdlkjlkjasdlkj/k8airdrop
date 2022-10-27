<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            
            <div class="modal-header bg-custom-dark">
                <h5 class="modal-title fw-bold" id="createUserLabel">Add new user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/users/store" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Full name</label>
                        <input required name="name" type="text" class="form-control" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input required name="email" type="text" class="form-control" id="email">
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label">Role</label>
                        <select name="position" id="position" class="form-control">
                            @foreach($positions as $position)
                                <option value="{{$position->id}}">{{$position->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="platform" class="form-label">Assign Platform</label>
                        <select name="platform" id="platform" class="form-control">
                            @foreach($platforms as $platform)
                                <option value="{{$platform->id}}">{{$platform->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Temporary Password</label>
                        <input required name="password" type="password" class="form-control" id="password">
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
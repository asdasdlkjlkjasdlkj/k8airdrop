<div class="modal fade" id="adminRolesModal" tabindex="-1" aria-labelledby="adminRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            
            <div class="modal-header bg-custom-dark">
                <h5 class="modal-title fw-bold" id="adminRolesLabel">Admin Roles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Role</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($positions as $position)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{$position->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
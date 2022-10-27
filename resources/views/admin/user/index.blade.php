@include('admin.partials.header')
@include('admin.partials.nav')
@include('admin.user.modal.create-user')
@include('admin.user.modal.update-user')
@include('admin.user.modal.admin-roles')
@include('admin.user.modal.add-platform')



<div class="row">
    <div class="col"><h3>Users Management</h3></div>
    <div class="col text-end">
        <button type="button" class="btn text-white bg-primary fw-bold" data-bs-toggle="modal" data-bs-target="#adminRolesModal">
            Admin roles
        </button>
        <button type="button" class="btn text-white bg-primary fw-bold" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Add new
        </button>
    </div>
</div>



<div class="row pt-4 mb-3">
    <div class="col">
        <form action="/admin/users" method="get">
            <div class="input-group">
                <input required name="q" class="form-control border-end-0 border" type="text" placeholder="search here...">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary bg-white border-start-0 border ms-n3" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                <span><a class="ms-2 fw-bold btn bg-primary text-white" href="/admin/users">Refresh</a></span>
             </div>
        </form>
    </div>
</div>



<div class="row">
    <div class="col">

    @if(isset($users))
        <table class="table table-bordered rounded mb-0 align-middle">
            <thead class="fw-bold text-dark bg-light">
                <tr>
                    <td>No.</td>
                    <td>@sortablelink('name')</td>
                    <td>@sortablelink('email')</td>
                    <td>Role</td>
                    <td>Platform</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                   
                    <td>
                        <ul class="list-inline m-0 p-0">
                            @foreach($user->positions as $position)
                            <li class="list-inline-item border-0 m-0 p-0">{{$position->name}}</li>
                            @endforeach
                        </ul>
                    </td>
                   
                    <td>
                        <ul class="list-inline m-0 p-0">
                            @foreach($user->platforms as $platform)
                            <li style="background:{{$platform->color}}" class="list-inline-item border-0 m-0 px-2 py-1 text-white fw-bold rounded-pill"><small>{{$platform->title}}</small> </li>
                            @endforeach
                        </ul>
                    </td>
                    
                    <td>
                        <span>
                            <a href="/admin/users/edit/{{$user->id}}" class="btn bg-transparent">
                                <i class="text-dark-2 fa-solid fa-pen-to-square"></i>
                            </a>
                        </span>
                        <span>
                            <button class="btn bg-transparent">
                                <i class="text-dark-2 fa-solid fa-trash-can"></i>
                            </button>
                        </span>
                        
                        <span>
                            <button class="btn bg-transparent" data-bs-toggle="modal" data-bs-id="{{$user->id}}" data-bs-name="{{$user->name}}" data-bs-target="#addPlatformModal">
                                <i class="text-dark-2 fa-solid fa-plus"></i>
                            </button>
                        </span>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
       
        @endif
    </div>
</div>












@include('admin.partials.footer')
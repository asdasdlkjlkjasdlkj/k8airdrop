@include('admin.partials.header')
@include('admin.partials.nav')
@include('admin.user.modal.add-platform')
@include('admin.user.modal.remove-platform')


<form action="/admin/users/update/{{$users->id}}" method="post">
    @method('PUT')
    @csrf
<div class="row mb-5">
    <div class="col"><h3>Update admin user</h3></div>
    <div class="col text-end">
        <button type="button" class="btn text-white bg-primary fw-bold mt-1" data-bs-toggle="modal" data-bs-id="{{$users->id}}" data-bs-target="#addPlatformModal">
            Assign platform
        </button>
        <button type="button" class="btn text-white bg-primary fw-bold mt-1" data-bs-toggle="modal" data-bs-id="{{$users->id}}" data-bs-target="#removePlatformModal">
            Remove platform
        </button>
        <button type="submit" class="btn text-white bg-primary fw-bold mt-1" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Save changes
        </button>

        
    </div>
</div>


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header fw-bold">Informations</div>
                    
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{$users->name}}">
                    </div>

                    <div class="mb-3">
                        <label for="email">Email address</label>
                        <input class="form-control" type="text" id="email" name="email" value="{{$users->email}}">
                    </div>

                    <div class="mb-3">
                        <label for="position">Role</label>
                        <select class="form-control" id="position" name="position">
                            @foreach($users_pivot as $user_position)
                                @foreach($user_position->positions as $position)
                                    <option value="{{$position->id}}">{{$position->name}}</option>
                                @endforeach
                            @endforeach
                            @foreach($positions as $position)
                                <option value="{{$position->id}}">{{$position->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input class="form-control" type="text" id="password" name="password" value="">
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card">
                <div class="card-header">Platforms</div>  
                <div class="card-body">
                    <div class="mb-3">
                        <label for="platform"></label>
                        @foreach($users_pivot as $user_platform)
                            @foreach($user_platform->platforms as $platform)
                               <label class="form-control border-0 border-bottom">{{$platform->title}}</label>
                            @endforeach
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@include('admin.partials.footer')
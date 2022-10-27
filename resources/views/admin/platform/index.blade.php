@include('admin.partials.header')
@include('admin.partials.nav')
@include('admin.platform.modal.create-platform')
@include('admin.platform.modal.update-platform')


<div class="row">
    <div class="col"><h3>Platform</h3></div>
    <div class="col text-end">
        <button type="button" class="btn text-white bg-primary fw-bold" data-bs-toggle="modal" data-bs-target="#createPlatformModal">
            Add new
        </button>
    </div>
</div>


<div class="row pt-4 mb-3">
    <div class="col">
        <form action="/admin/airdrop/platform" method="get">
            <div class="input-group">
                <input required name="q" class="form-control border-end-0 border" type="text" placeholder="search here...">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary bg-white border-start-0 border ms-n3" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                <span><a class="ms-2 fw-bold btn bg-primary text-white" href="/admin/airdrop/platform">Refresh</a></span>
             </div>
        </form>
    </div>
</div>


<div class="row">
    <div class="col">
        <table class="table table-bordered rounded mb-0 align-middle">
            <thead class="fw-bold text-dark bg-light">
                <tr>
                    <td>No.</td>
                    <td>@sortablelink('title')</td>
                    <td>Color</td>
                    <td>@sortablelink('created_at')</td>
                    <td>Created by</td>
                    <td>No. of Promos</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($platforms as $platform)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{$platform->title}}</td>
                    <td><input type="color" value="{{$platform->color}}" disabled/></td>
                    <td>{{$platform->created_at}}</td>
                    <td>Super Admin</td>
                    <td></td>
                    <td>
                        <span>
                            <button class="btn bg-transparent">
                                <i class="text-dark-2 fa-solid fa-pen-to-square"></i>
                            </button>
                        </span>
                        <span>
                            <button class="btn bg-transparent">
                                <i class="text-dark-2 fa-solid fa-trash-can"></i>
                            </button>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.partials.footer')



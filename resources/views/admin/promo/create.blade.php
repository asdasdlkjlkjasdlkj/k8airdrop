@include('admin.partials.header')
@include('admin.partials.nav')

<form action="/admin/airdrop/promo/store" method="post" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col"><h3>Create Airdrop Promo</h3></div>
    <div class="col text-end">
        <button type="submit" class="btn text-white bg-primary fw-bold">
            Save promo
        </button>
    </div>
</div>

<div class="row mt-5">
    <div class="col">

        @if(Auth::user()->isSuperAdmin())
        <div class="mb-3">
            <label for="name">Assign Admin</label>
            <div class="row mt-2">
            @foreach($users as $user)
                <div class="col">
                    <input type="checkbox" class="form-check-input" id="title" name="users_check[]" value="{{$user->id}}">
                    <label for="name" class="form-check-label">{{$user->name}}</label>
                </div>
            @endforeach
            </div>
        </div>
        @endif

        <div class="mb-3">
            <label for="title">Promo Title</label>
            <input required type="text" class="form-control" id="title" name="title">
        </div>

        <div class="mb-3">
            <label for="title">Platform</label>
            <select required class="form-control" name="platform" id="platform">
            @if(Auth::user()->isSuperAdmin())
                @foreach($platforms as $platform)
                    <option value="{{$platform->id}}">{{$platform->title}}</option>
                @endforeach
            @else
                @foreach($user_platforms->platforms as $platform)
                    <option value="{{$platform->id}}">{{$platform->title}}</option>
                @endforeach
            @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="title">Promo type</label>
            <select required class="form-control" name="type" id="type">
                <option value="click_to_join">Click to join</option>
                <option value="click_to_redeem">Click to redeem</option>
            </select>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <div class="col">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="prize_pool">Prize Pool</label>
                    <input type="text" class="form-control" id="prize_pool" name="prize_pool">
                </div>
                <div class="col">
                    <label for="end_date">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="Inactive">Inactive</option>
                        <option value="Active">Active</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="link">Link</label>
            <input type="text" class="form-control" id="link" name="link">
        </div>

        <div class="mb-3">
            <label for="embedded_code">Embedded code (Optional)</label>
            <textarea type="text" style="height:150px" class="form-control" id="embedded_code" name="embedded_code"></textarea>
        </div>

        <div class="mb-3">
            <label for="image">Thumbnail</label>
            <input required type="file" class="form-control" id="image" name="image">
        </div>
    </div>
</div>
</form>

@include('admin.partials.footer')
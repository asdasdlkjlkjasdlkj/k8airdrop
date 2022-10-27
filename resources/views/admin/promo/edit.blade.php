@include('admin.partials.header')
@include('admin.partials.nav')



@if($promos->status == "Archive")
    This promo already archived.
@else
<form action="/admin/airdrop/promo/update/{{$promos->id}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
<div class="row">
    <div class="col"><h3>Update Airdrop Promo</h3></div>
    <div class="col text-end">
        <button type="submit" class="btn text-white bg-primary fw-bold">
            Save changes
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
                    <input
                        type="checkbox"
                        class="form-check-input"
                        name="users_check[]"
                        value="{{$user->id}}"
                    
                        @foreach($user_assigns as $user_assign)
                            @foreach($user_assign->users as $user_assign)
                                {{($user->id == $user_assign->id ? 'checked' : '')}}
                            @endforeach
                        @endforeach
                        />

                    <label for="name" class="form-check-label">{{$user->name}}</label>
                </div>
            @endforeach
            </div>
        </div>
        @endif

        <div class="mb-3">
            <label for="title">Promo Title</label>
            <input required type="text" class="form-control" id="title" name="title" value="{{$promos->title}}">
        </div>

        <div class="mb-3">
            <label for="platform">Platform</label>
            <select required class="form-control" name="platform" id="platform">
                @foreach($promo_pivot as $promo_platform)
                    @foreach($promo_platform->platforms as $platform)
                    <option value="{{$platform->id}}">{{$platform->title}}</option>
                    @endforeach
                @endforeach
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
            <label for="type">Promo type</label>
            <select required class="form-control" name="type" id="type">
                <option value="{{$promos->type}}">@if($promos->type == "click_to_join") Click to join @elseif($promos->type == "click_to_redeem") Click to redeem @endif</option>
                <option value="click_to_join">Click to join</option>
                <option value="click_to_redeem">Click to redeem</option>
            </select>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{$promos->start_date}}">
                </div>
                <div class="col">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{$promos->end_date}}">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="prize_pool">Prize Pool</label>
                    <input type="text" class="form-control" id="prize_pool" name="prize_pool" value="{{$promos->prize_pool}}">
                </div>
                <div class="col">
                    <label for="end_date">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="{{$promos->status}}">{{$promos->status}}</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Active">Active</option>
                        <option value="Archive">Archive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="link">Link</label>
            <input type="text" class="form-control" id="link" name="link" value="{{$promos->link}}">
        </div>

        <div class="mb-3">
            <label for="embedded_code">Embedded code (Optional)</label>
            <textarea style="height:150px" class="form-control" id="embedded_code" name="embedded_code">{{$promos->embedded_code}}</textarea>
        </div>


        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input value="{{old('image')}}" name="image" type="file" class="form-control mb-2">
            <small>Image file should be less than 1mb file size and JPG/JPEG or PNG in format.</small>
        </div>

        <div class="mb-3">
            <img class="img-large" width="350px" id="image" src="{{url('images/' . $promos->image)}}" alt="" >
        </div>
       
    </div>
</div>
</form>
@endif

@include('admin.partials.footer')
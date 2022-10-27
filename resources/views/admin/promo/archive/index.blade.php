@include('admin.partials.header')
@include('admin.partials.nav')


<div class="row">
    <div class="col"><h3>Airdrop Promos Archive</h3></div>
</div>


<div class="row pt-4 mb-3">
    <div class="col">
        <form action="/admin/airdrop/promo/archive" method="get">
            <div class="input-group">
                <input required name="search" class="form-control border-end-0 border" type="text" placeholder="Search promo here...">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary bg-white border-start-0 border ms-n3" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                <span><a id="reset_button" class="ms-2 fw-bold btn bg-primary text-white" href="/admin/airdrop/promo/archive">Refresh</a></span>
             </div>
        </form>
    </div>
</div>



<div class="row pt-2 mb-3">
    <div class="col">
        <form action="/admin/airdrop/promo/archive" method="get" id="queryForm">
        <div class="mb-2">Sort by platform and months</div>
        <div class="row d-table" >
            <div class="col d-table-cell" style="width:22.5%">
                <label for=""><small>Select status</small></label>
                <select id="status" name="status" class="form-control rounded">
                    <option value="All">All</option>
                </select>
            </div>
            <div class="col d-table-cell" style="width:22.5%">
                <label for=""><small>Select platform</small></label>
                <select id="platform" name="platform" class="form-control rounded">
                    <option value="">All</option>
                    @if(Auth::user()->isSuperAdmin())
                        @foreach($platforms as $platform)
                        <option value="{{$platform->id}}">{{$platform->title}}</option>
                        @endforeach
                
                    @else                     
                        @foreach($platform_users as $platform_user)
                            @foreach($platform_user->platforms as $platform)
                                <option value="{{$platform->id}}">{{$platform->title}}</option>
                            @endforeach
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col d-table-cell" style="width:22.5%">
                <label for=""><small>Date from</small></label>
                <input name="start_date" class="form-control rounded" type="date" value="{{ request()->input('start_date') }}">
            </div>
            <div class="col d-table-cell" style="width:22.5%">
                <label for=""><small>Date to</small></label>
                <input name="end_date" class="form-control rounded" type="date" value="{{ request()->input('end_date') }}">
            </div>
            <div class="col d-table-cell align-bottom text-end" style="width:5%">
                
                <a href="#" onclick="document.getElementById('queryForm').submit()" type="submit" class="align-bottom ms-2 fw-bold btn bg-primary text-white">Submit</a>
            </div>
        </div>     

        </form>
    </div>
</div>





<div class="row mb-5">
    <div class="col">
        <table class="table table-bordered rounded mb-0 align-middle">
            <thead class="fw-bold text-dark bg-light">
                <tr>
                    <td>No.</td>
                    <td>Promo</td>
                    <td>Platform</td>
                    <td>Prize pool</td>
                    <td>Start date</td>
                    <td>End date</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @if(Auth::user()->isSuperAdmin())
                    @foreach($promos as $promo)
                    <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$promo->title}}</td>
                        <td>
                            @foreach($promo->platforms as $platform)
                                <small class="text-white fw-bold rounded-pill px-2 py-1" style="background:{{$platform->color}}">{{$platform->title}}</small>
                            @endforeach
                        </td>
                        <td>{{$promo->prize_pool}}</td>
                        <td>{{date('M j, Y',  strtotime($promo->start_date))}}</td>
                        <td>{{date('M j, Y',  strtotime($promo->end_date))}}</td>
                        <td><small class="@if($promo->status == 'Archive') bg-primary @else bg-danger @endif fw-bold text-white px-2 py-1 rounded-pill">{{$promo->status}}</small></td>
                        <td>
                           
                            <span>
                                <a href="/admin/airdrop/promo/view/{{$promo->id}}" class="btn bg-transparent">
                                    <i class="text-dark-2 fa-solid fa-eye"></i>
                                </a>
                            </span>
                           
                        </td>
                    </tr>
                    @endforeach
                @else
                    @if($promos->count() > 0)
                    @foreach($promos as $promo)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{$promo->title}}</td>
                            <td>
                                @foreach($promo->platforms as $platform)
                                    <small class="text-white fw-bold rounded-pill px-2 py-1" style="background:{{$platform->color}}">{{$platform->title}}</small>
                                @endforeach
                            </td>
                            <td>{{$promo->prize_pool}}</td>
                            <td>{{$promo->start_date}}</td>
                            <td>{{$promo->end_date}}</td>
                            <td><small class="@if($promo->status == 'Archive') bg-primary @else bg-danger @endif fw-bold text-white px-2 py-1 rounded-pill">{{$promo->status}}</small></td>
                            <td>
                                <span>
                                    <a href="/admin/airdrop/promo/view/{{$promo->id}}" class="btn bg-transparent">
                                        <i class="text-dark-2 fa-solid fa-eye"></i>
                                    </a>
                                </span>
                                
                            </td>
                        </tr>
                        
                    @endforeach
                    @else
                            <tr>
                                <td>No promos available</td>
                            </tr>
                        @endif
                @endif
            </tbody>
        </table>

    </div>
</div>

@include('admin.partials.footer')


<script>
$(function() {
    if (localStorage.getItem('status')) {
        $("#status option").eq(localStorage.getItem('status')).prop('selected', true);
    }
    $("#status").on('change', function() {
        localStorage.setItem('status', $('option:selected', this).index());
    });
});
</script>

<script>
$(function() {
    if (localStorage.getItem('platform')) {
        $("#platform option").eq(localStorage.getItem('platform')).prop('selected', true);
    }
    $("#platform").on('change', function() {
        localStorage.setItem('platform', $('option:selected', this).index());
    });
});
</script>

<script>
$("#reset_button").click(function() {
    $('select').prop('selectedIndex', 0);
});
</script>

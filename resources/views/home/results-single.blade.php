@include('home.partials.header')


<div class="row p-5">
    <div class="col">

        <div class="row">
            <div class="col">
                @include('home.partials.nav')
                @include('home.partials.title')

                <div class="container" style="margin-top:100px"></div>
                <div class="container mx-auto p-1 rounded" style="width:100%;margin-top:15px">
                    
                    
                    <div class="row bg-custom-dark rounded p-3 m-0" >
                        <div class="row">
                            <div class="col-3 p-0"><img src="{{url('images/' . $promos->image)}}" alt="" class="img-fluid rounded"></div>
                            <div class="col-9 pe-4">
                                <div><h4>{{$promos->title}}</h4></div>
                                <div class="text-custom-secondary mt-1">
                                    @foreach($promos->platforms as $platform)
                                        Platform: {{$platform->title}}
                                    @endforeach
                                </div>
                                <div class="text-custom-secondary mt-1">
                                    Promo type: @if($promos->type == "click_to_join") Click to Join @elseif($promos->type == "click_to_redeem") Click to redeem @endif
                                </div>
                                <div class="text-custom-secondary mt-1">
                                    Prize pool: {{$promos->prize_pool}}
                                </div>
                                <div class="text-custom-secondary mt-1">
                                    Duration: {{date('M j, Y',  strtotime($promos->start_date))}} - {{date('M j, Y',  strtotime($promos->end_date))}}
                                </div>
                                <div class="text-custom-secondary mt-3">
                                    Total participants:  @if($promos->type == "click_to_join") {{$promos->participants->count()}} @else N/A @endif
                                </div>
                                <div class="text-custom-secondary mt-1">
                                    Total Winners: @if($promos->type == "click_to_join") {{$promos->participants->where('winner', 'Yes')->count()}} @else N/A @endif
                                </div>
                            </div>
                        </div>


                        @if($promos->type == "click_to_join")
                            <div class="row mt-3">
                                <div class="col p-0">
                                    <div class="me-2">
                                    Participants
                                        <table class="table mt-2" style="background:#1b2135; border:1px solid #161c2d">
                                            <thead style="background:#161c2d">
                                                <tr>
                                                    <td class="text-white">No.</td>
                                                    <td class="text-white">Name/Username</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($promos->participants as $participant)
                                                <tr>
                                                    <td class="text-custom-secondary" scope="row">{{$loop->iteration}}</td>
                                                    <td class="text-custom-secondary">
                                                        {{$participant->name}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col p-0">
                                    <div class="me-2">
                                        Winners
                                        <table class="table mt-2" style="background:#1b2135; border:1px solid #161c2d">
                                            <thead style="background:#161c2d">
                                                <tr>
                                                    <td class="text-white">No.</td>
                                                    <td class="text-white">Name/Username</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($promos->participants->where('winner', 'Yes') as $participant)
                                                <tr>
                                                    <td class="text-custom-secondary" scope="row">{{$loop->iteration}}</td>
                                                    <td class="text-custom-secondary">
                                                        {{$participant->name}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@include('home.partials.footer')

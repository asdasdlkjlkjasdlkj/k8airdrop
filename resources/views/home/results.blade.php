@include('home.partials.header')


<div class="row p-5">
    <div class="col">

        <div class="row">
            <div class="col">
                @include('home.partials.nav')
                @include('home.partials.title')

                <div class="container" style="margin-top:100px">List of promos</div>
                <div class="container mx-auto p-1 pb-0 rounded" style="width:100%; margin-top:15px">
                    
                    @foreach($promos as $promo)
                    <div class="row bg-custom-dark mb-1 rounded px-0 py-2 m-0" id="promo-list" style="border-left:5px solid @foreach($promo->platforms as $platform) {{$platform->color}} @endforeach">
                        <a href="/promo/result/{{$promo->slug}}/{{$promo->url_id}}" class="text-decoration-none text-white">
                            <div class="row m-0 p-0">
                                <div class="col-1 px-2 text-center text-custom-secondary">
                                    <div><h4 class="fw-bold">{{date('M', strtotime($promo->start_date))}}</h4></div>
                                    <div>{{date('j', strtotime($promo->start_date))}}</div>
                                </div>
                                <div class="col-8 px-2">
                                    <div>{{$promo->title}}</div>
                                    <div class="text-custom-secondary">
                                        <small>
                                            @foreach($promo->platforms as $platform)
                                                <div>Platform: {{$platform->title}}</div>
                                            @endforeach
                                        </small>
                                    </div>
                                    <div class="text-custom-secondary"><small>Prize pool: {{$promo->prize_pool}}</small></div>
                                </div>
                                <div class="col-3 text-end"><i class="fa-solid fa-arrow-right"></i></div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>




            </div>
        </div>
    </div>
</div>


@include('home.partials.footer')

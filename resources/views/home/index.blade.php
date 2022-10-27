@include('home.partials.header')

<div class="row p-5">
    <div class="col">

        <div class="row">
            <div class="col">
                @include('home.partials.nav')

                @include('home.partials.title')

                <div class="container" style="margin-top:100px;">
                    <!-- <div class="row row-cols-1">
                        <div class="col">
                            <div class="row">
                                <div class="col p-5 m-3" style="background:#1e2439; border-radius:20px">Upviral</div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                        @foreach($promos as $promo)
                            <div class="col">
                                <div class="row">
                                    <div class="col m-3" style="background:#1e2439; border-radius:20px">

                                    <a href="{{$promo->link}}" target="_blank" class="text-decoration-none text-white russo">
                                        <div class="row position-relative text-center">
                                            <div style="position:absolute; bottom:0">
                                                <h5>Prize pool: {{$promo->prize_pool}}</h5>
                                            </div>
                                            <img src="{{url('images/' . $promo->image)}}" alt="" class="img-fluid p-0" style="border-radius:20px">
                                        </div>
                                        <div class="row p-0">
                                            <div class="col p-3">
                                                <h5 class="m-0">{{$promo->title}}</h5>
                                                <small class="text-custom-secondary p-0 m-0"> Duration: {{date('M j, Y',  strtotime($promo->start_date))}} - {{date('M j, Y',  strtotime($promo->end_date))}}</small>
                                            </div>
                                        </div>
                                    </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('home.partials.footer')

<script type="text/javascript">
    $(document).ready(function() {

    var url = window.location.href;
    if(url.IndexOf('/register') != -1) {
        $('#registerParticipantModal').modal('show');
    }
});
</script>
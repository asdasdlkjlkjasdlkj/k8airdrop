@include('home.partials.header')


<div class="row p-5">
    <div class="col">

        <div class="row">
            <div class="col">
                @include('home.partials.nav')
                @include('home.partials.title')




               
                   
             
                <div class="container mx-auto p-1 rounded" style="width:720px; margin-top:100px">
                    <div class="bg-custom-dark pb-4 rounded">
                        <div class="rounded text-center" style="height:500px; width:100%; background-image:url('{{url('images/' . $promos->image)}}'); background-position:center; position:relative; background-repeat:no-repeat; background-size:cover">
                            <div class="w-100 bg-custom-dark " style="position:absolute; top:0">
                                <div class="row">
                                    @if($promos->type == "click_to_join")
                                        <div class="col" style="border-right:3px solid #2c3257">
                                            <div class="py-2">
                                                <div class="text-custom-secondary"><small>Total participants</small></div>
                                                <div class="fw-bold"><h5 class="m-0">{{$promos->participants->count()}}</h5></div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col" style="border-right:3px solid #2c3257">
                                        <div class="py-2">
                                            <div class="text-custom-secondary"><small>Prize Pool</small></div>
                                            <div class="fw-bold"><h5 class="m-0">{{$promos->prize_pool}}</h5></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="py-2">
                                            <div class="text-custom-secondary"><small>Days Left</small></div>
                                            <div class="fw-bold"><h5 class="m-0">{{$days_left}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center roboto"><h4 class="fw-bold">{{$promos->title}}</h4></div>
                        <div class="mt-1 text-custom-secondary text-center roboto">Duration: {{date('F j, Y', strtotime($promos->start_date))}} - {{date('F j, Y', strtotime($promos->end_date))}}</div>

                        <div class="mt-5 bg-custom-dark px-3">


                        @if($promos->type == "click_to_join")
                            <form action="/promo/{{$promos->slug}}/{{$promos->url_id}}/store_register" method="post" class="roboto">
                                @csrf
                                <div class="">
                                    <div class="mb-2 text-custom-secondary">Fill up the form below to join this promo.</div>
                                    <div class="mb-4 text-custom-secondary">
                                        <label for="name">Name/Username</label>
                                        <input required type="text" name="name" id="name" class="form-control mt-2 rounded px-2">
                                    </div>
                                    <div class="mb-4 text-custom-secondary">
                                        <label for="email">Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control mt-2 rounded px-2">
                                    </div>
                                    <div class="mb-4 text-custom-secondary">
                                        <label for="k8_username">k8 username(optional)</label>
                                        <input type="text" name="k8_username" id="k8_username" class="form-control mt-2 rounded px-2">
                                    </div>
                                    <div>
                                        <button type="submit" class="w-25 form-control rounded px-4 py-2 border-0" style="background:#6b00d7; color:#FFF">Join</button>
                                    </div>
                                </div>
                            </form>
                        @elseif($promos->type == "click_to_redeem")

                            @if($promos->codes->count() != 0)
                                @foreach($promos->codes->random(1) as $code)
                                    <div class="text-center">
                                        <h3 id="code">{{$code->name}}</h3>
                                        <form action="https://k8.io/member/redemption-code" method="get" target="_blank">
                                            <button onclick="copyToClipboard('#code')" class="btn rounded-pill mt-4" style="background:#6b00d7; color:#FFF">Copy and Claim</button>
                                        </form>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center">No promo codes yet. Please stay tuned for this promo.</div>
                            @endif
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('home.partials.footer')


<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

</script>
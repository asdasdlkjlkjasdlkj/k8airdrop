@include('home.partials.header')


<div class="row p-5">
    <div class="col">

        <div class="row">
            <div class="col">
                @include('home.partials.nav')
                <!-- @include('home.partials.title') -->

                <div class="container text-center pt-3" style="margin-top:100px">
                    
                  
                </div>


                <div class="container" style="margin-top:100px">
                    <div class="row">
                        <div class="col text-center">
                            <div><h1>Congratulations! </h1></div>

                            <div>
                                <h5 class="text-custom-secondary pt-2" style="line-height:30px">
                                You have now joined the promo. <br>Please stay tuned for our announcement of winners! <br>
                                Happy gambling :)
                                </h5>
                            </div>
                            <div class="mt-5">
                                <a href="/" type="submit" class="text-decoration-none text-center w-25 mt-5 rounded-pill px-4 py-2 border-0" style="background:#6b00d7; color:#FFF">Return to promos</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('home.partials.footer')

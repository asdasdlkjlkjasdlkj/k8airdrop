@include('admin.partials.header')
@include('admin.partials.nav')





<div class="row">
    <h3>At a glance</h3>
    <div class="col">
        <script src="https://crypto.com/price/static/widget/index.js"></script>
        <div
        id="crypto-widget-CoinMarquee"
        data-transparent="true"
        
        data-design="modern"
        data-coin-ids="1,166,136,1120,382,20,1694,440,1986,29">
        </div>
    </div>
</div>

<div class="row ">
    <div class="col mx-3">
        <div class="row bg-light text-dark rounded">
            <div class="col p-3 rounded">
                <h3 class="text-dark">{{$promo_all_count}}</h3>
                <p>Total number of promos</p>
            </div>
       </div>
    </div>
    <div class="col mx-3">
        <div class="row bg-light text-dark rounded">
            <div class="col p-3  rounded">
                <h3 class="text-dark">{{$promo_active_count}}</h3>
                <p>Total number of active promo</p>
            </div>
       </div>
    </div>
    <div class="col mx-3">
        <div class="row bg-light text-dark rounded">
            <div class="col p-3  rounded">
                <h3 class="text-dark">{{$participants->count()}}</h3>
                <p>Total number of participants</p>
            </div>
       </div>
    </div> 
    <div class="col mx-3">
        <div class="row bg-light text-dark rounded">
            <div class="col p-3  rounded">
                <h3 class="text-dark">{{$users->count()}}</h3>
                <p>Total number of admin</p>
            </div>
       </div>
    </div>
</div>


@include('admin.partials.footer')

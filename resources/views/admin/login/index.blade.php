@include('admin.partials.header')
<section class="vh-100 bg-custom-dark">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-dark rounded border-0">
                    <div class="card-body p-5 text-left">

                        <form action="/admin/login/process" method="post">
                        @csrf
                            <h5 class="fw-bold mb-2 text-uppercase">Airdrop Login</h5>
                            <p class="text-secondary">Please enter your login and password!</p>

                            @error('email')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                            @enderror

                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input name="email" type="email" class="form-control" placeholder="Enter email address" />
                            </div>

                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="password">Password</label>    
                                <input name="password" type="password" class="form-control" placeholder="Enter password" />
                            </div>

                            <button class="rounded-50 text-white fw-bold btn bg-primary btn-md px-5" type="submit">Login</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('admin.partials.footer')
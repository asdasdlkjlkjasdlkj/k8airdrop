@if(session()->has('message'))

<div style="z-index:100" class="mb-3 me-3 position-fixed bottom-0 end-0 alert alert-success alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Alert Message!</strong><br> {{session('message')}}
  </div>
@endif
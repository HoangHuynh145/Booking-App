@if(Session::has('success'))
<div class="card-body">
    <div class="alert alert-solid-success alert-dismissible" role="alert">
      {{ Session::get('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@elseif (Session::has('error'))
<div class="card-body">
    <div class="alert alert-solid-danger alert-dismissible" role="alert">
        {{ Session::get('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if (Session::has('success_massage'))
    <div class=" container alert alert-success alert-box" style="display:block;animation: fadeIn 2s forwards 3s;">
        {{ $slot }}
    </div>
@elseif(Session::has('error_massage'))
<div class="container alert alert-danger alert-box" style="display:block;animation: fadeIn 2s forwards 3s;">
    {{ $slot }}
</div>
@endif

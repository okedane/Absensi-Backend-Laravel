<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast @if ($errors->any() || session('success') || session('error')) show @endif" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header 
            @if(session('success')) bg-primary text-primary 
            @elseif(session('error')) bg-danger text-danger
            @endif">
            <img src="assets/images/logo-sm.svg" alt="" class="me-2" height="18">
            <strong class="me-auto">PM Sumenep</strong>
            <small class="text-muted">Just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        {{-- <div class="toast-body">
            @if (session('success'))
                {{ session('success') }}
            @elseif (session('error'))
                {{ session('error') }}
            @elseif ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
        </div> --}}
        <div class="toast-body 
        @if(session('success')) text-success 
        @elseif(session('error')) text-danger 
        @endif">
        {{ session('success') ?? session('error') }}
    </div>
    </div>
</div>

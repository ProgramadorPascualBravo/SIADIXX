@if (session()->has('success'))
    <div class="callout success medium-10 auto" data-closable>
        {{ session('success') }}
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('error'))
    <div class="callout alert medium-10 auto">
        {{ session('error') }}
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

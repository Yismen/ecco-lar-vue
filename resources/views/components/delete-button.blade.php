
<delete-request-button url="{{ $url }}"
    @if (isset($btnText))
        btnText="{{ $btnText }}"
    @endif
    @if (isset($redirect))
        redirect-url="{{ $redirect }}"        
    @endif
></delete-request-button>
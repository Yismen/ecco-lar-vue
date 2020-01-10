
<delete-request-button url="{{ $url }}"
    @if (isset($redirect))
        redirect-url="{{ $redirect }}"        
    @endif
></delete-request-button>
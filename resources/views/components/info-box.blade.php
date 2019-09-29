<div class="info-box">
    <span class="info-box-icon {{ $color ?? 'bg-red' }}" ><i class="{{ $icon ?? 'fa fa-star-o' }}"></i></span>
    <div class="info-box-content">
        <div class="info-box-text">{{ $slot }}</div>
        <div class="info-box-number">{{ $number ?? 1,500 }}</div>
    </div>
</div>

<div class="info-box">
    <span class="info-box-icon {{ $color ?? 'bg-red' }}" ><i class="{{ $icon ?? 'fa fa-star-o' }}"></i></span>
    <div class="info-box-content">
        <div class="info-box-text" title="{{ $slot }}">{{ $slot }}</div>
        <div class="info-box-number">{{ $number }}</div>
        @isset($project)
            <span class="info-box-text"> 
                {{-- Proj.: {{ number_format($number / now()->day * now()->daysInMonth, 0) }} --}}
            </span>
        @endisset
    </div>
</div>

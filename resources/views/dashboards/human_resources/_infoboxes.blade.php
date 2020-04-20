<div class="col-xs-6 col-md-4 col-lg-3"> 
    @component('components.info-box',[
        'number' => $head_count,
        'color' => 'bg-blue-active',
        'icon' => 'fa fa-users',
    ]) 
        Employees 
    @endcomponent
</div>
{{-- /.info-box --}}
<div class="col-xs-6 col-md-4 col-lg-3"> 
    @component('components.info-box',[
        'number' => number_format($attrition_mtd, 2) . '%',
        'color' => 'bg-yellow-active',
        'icon' => 'fa fa-chain-broken',
    ]) 
        MTD Attrition 
    @endcomponent
</div>
{{-- /.info-box --}}
<div class="col-xs-6 col-md-4 col-lg-3"> 
    @component('components.info-box',[
        'number' => $hired_tm,
        'color' => 'bg-green-active',
        'icon' => 'fa fa-link',
    ]) 
        MTD Hires 
    @endcomponent
</div>
{{-- /.info-box --}}
<div class="col-xs-6 col-md-4 col-lg-3"> 
    @component('components.info-box',[
        'number' => $terminated_tm,
        'color' => 'bg-red-active',
        'icon' => 'fa fa-chain-broken',
    ]) 
        MTD Terminations 
    @endcomponent
</div>
{{-- /.info-box --}}
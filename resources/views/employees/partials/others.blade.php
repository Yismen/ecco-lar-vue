	<div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <div class="box box-danger">
                    <employee-supervisor :employee="{{ $employee }}"></employee-supervisor>
                </div>
            </div>
            {{-- /. supervisor --}}
           <div class="col-sm-6">
                <div class="box box-success">
                        <employee-social-security :employee="{{ $employee }}"></employee-social-security>
                </div>
           </div> 
           {{-- /. Social Security   --}}
           <div class="clearfix"></div>
           <div class="col-sm-6">
                <div class="box box-warning">
                        <employee-nationality :employee="{{ $employee }}"></employee-nationality>
                </div>
           </div>   
           {{-- ./ Nationality --}}
    </div>
</div>






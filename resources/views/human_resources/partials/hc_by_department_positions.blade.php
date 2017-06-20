<div class="box box-primary danger-bg">
    <div class="box-header with-border"><h3>Total Employees by Proyect - Positions</h3></div>

         {{-- <div class="accordion" id="accordion">
             <div class="accordion-group">
                 <div class="accordion-heading">
                     <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                         Collapsible Group Item #1
                     </a>
                 </div>
                 <div id="collapseOne" class="accordion-body collapse in">
                     <div class="accordion-inner">
                         Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                     </div>
                 </div>
             </div>
             
         </div> --}}


    <div class="box-body">

        @foreach ($by_department_positions as $department)

            <ul class="list-group">
                <li class="list-group-item">
                    <table class="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    <h4>
                                        <a href="/admin/human_resources/employees/by_departments/{{ $department->id }}">{{ $department->department }}</a>
                                    </h4>
                                </th>
                                <th>
                                   <h4> 
                                        {{ $department->positions->sum(function($position) {
                                           return $position->employees->sum('employees_count');
                                        }) }}
                                    </h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($department->positions as $position)
                                <tr>
                                    <th colspan="2">
                                        <a href="/admin/human_resources/employees/by_positions/{{ $position->id }}">{{ $position->name }}</a>
                                            @foreach ($position->employees as $employee)
                                                <tr>
                                                    <td>{{ $employee->gender->gender }}</td>
                                                    <td class="col-sm-2">{{ $employee->employees_count }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th><span class="pull-right">Total</span></th>
                                                <th>{{ $position->employees->sum('employees_count') }}</th>
                                            </tr>
                                    </th>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </li>
            </ul>
                
        @endforeach
        {{-- {{ dd($by_department->positions) }} --}}
        {{-- {{ $by_department->positions->employees->sum('employees_count') }} --}}
    </div>

    <div class="box-footer"></div>
    
</div>
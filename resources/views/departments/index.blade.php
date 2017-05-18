@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Departments', 'page_description'=>'List of departments available.'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary pad">
            <div class="table table-responsive table-striped">
                {{-- <div id="people">
                  <v-server-table url="/admin/departments" :columns="departments" :options="options"></v-server-table>
                </div> --}}
                <table class="table table-condensed table-striped table-hover" id="description">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>
                                <a href="{{ route('admin.departments.create') }}">
                                     <h5>Add <i class="fa fa-plus"></i></h5>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    {{-- Datatables will render this --}}
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.departments.show', $department->id) }}">
                                        <i class="fa fa-building"></i> {{ $department->department }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.departments.edit', $department->id) }}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $departments->render() }}
            </div>

			{{-- {{ $departments }} --}}
		</div>
	</div>
@stop
			
@section('scripts')
    <script type="text/javascript">
        $(document).ajaxStart(function() { Pace.restart(); });
    </script>
@stop
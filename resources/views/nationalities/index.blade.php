@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Nationalities', 'page_description'=>'List of nationalities of production.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box-header with-border">
                    <h3>
                        Nationalities List
                        <a href="{{ route('admin.nationalities.create') }}" class="pull-right">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </h3>
                </div>

                <form action="/admin/nationalities/employees" method="POST">
                    @csrf

                    @if ($free_employees->count() > 0)
                        <div class="box box-danger">
                            <div class="box-header">
                                <h4>
                                    List of Employees Not Assigned to Any Nationality
                                    <span class="badge bg-yellow">{{ $free_employees->count() }}</span>
                                </h4>
                            </div>

                            <?php $count = $free_employees->count() == 0 ? 0 : ceil($free_employees->count() / 2) ?>

                            <div class="box-body">
                                <div class="row">
                                    @foreach ($free_employees->chunk($count) as $chunk)
                                        <div class="col-sm-6">
                                            @foreach ($chunk as $employee)
                                                 <employee-check-box :employee="{{ $employee }}" style="border-top: solid 1px #ccc"
                                                >,
                                                    - {{ filled($employee->personal_id) ? $employee->personal_id : $employee->passport }}
                                                </employee-check-box>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @foreach ($nationalities as $nationality)
                        @if ($nationality->employees->count() > 0)
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h4>
                                        <a href="{{ route('admin.nationalities.show', $nationality->id) }}" title="Details">{{ $nationality->name }}</a>
                                        <span class="badge bg-red">{{ $nationality->employees->count() }}</span>
                                        <a href="{{ route('admin.nationalities.edit', $nationality->id) }}" class="pull-right text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </h4>
                                </div>
                                    <div class="box-body">

                                        <?php $count = $nationality->employees->count() == 0 ? 0 : ceil($nationality->employees->count() / 2) ?>

                                        <div class="box-body">
                                            <div class="row">
                                                @foreach ($nationality->employees->chunk($count) as $chunk)
                                                    <div class="col-sm-6">
                                                        @foreach ($chunk as $employee)
                                                             <employee-check-box :employee="{{ $employee }}" style="border-top: solid 1px #ccc"
                                                            >,
                                                                {{ filled($employee->personal_id) ? $employee->personal_id : $employee->passport }}
                                                            </employee-check-box>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="col-sm-4 col-xs-7" style="position: fixed; bottom: 35%; right: 30px; padding: 15px ;  background-color: whitesmoke; border: darkgray; border-style: solid; border-width: thin;">
                        <div class="input-group">
                            {{ Form::select('nationality', $nationalities->pluck('name', 'id'), null, ['class' => 'form-control']) }}
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-warning">Re-Assign</button>
                            </span>
                        </div>

                        @include('layouts.partials.errors')
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush

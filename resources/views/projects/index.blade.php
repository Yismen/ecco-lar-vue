@php
    use Illuminate\Support\Str;
@endphp
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Projects', 'page_description'=>'List of projects of production.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box-header with-border">
                    <h3>
                        Projects List
                        <a href="{{ route('admin.projects.create') }}" class="pull-right">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </h3>
                </div>

                <form action="/admin/projects/employees" method="POST">
                    @csrf

                    @foreach ($projects as $project)
                        @if ($project->employees->count() > 0)
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h4>
                                        <a href="{{ route('admin.projects.show', $project->id) }}">{{ $project->name }}</a>
                                        <span class="badge bg-red">{{ $project->employees->count() }}</span>
                                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="pull-right text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </h4>
                                </div>
                                @if ($project->employees->count() > 0)
                                    <div class="box-body">
                                        <table class="table table-condensed table-hover">
                                            <tbody>
                                                @foreach ($project->employees as $employee)
                                                    <tr class="col-md-4 col-sm-6">
                                                        <td>
                                                            <employee-check-box :employee="{{ $employee }}"
                                                            >,
                                                                {{ optional($employee->position)->name }}
                                                            </employee-check-box>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <div class="col-sm-4 col-xs-7" style="position: fixed; bottom: 35%; right: 30px; padding: 15px ;  background-color: whitesmoke; border: darkgray; border-style: solid; border-width: thin;">
                        <div class="input-group">
                            {{ Form::select('project', $projects->filter(function($key,$value){return ! Str::contains($key->name, 'Downtimes');})->pluck('name', 'id'), null, ['class' => 'form-control']) }}
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

@section('scripts')
@stop

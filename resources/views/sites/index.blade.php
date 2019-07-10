@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Sites', 'page_description'=>'List of sites of production.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box-header with-border">
                    <h3>
                        Sites List
                        <a href="{{ route('admin.sites.create') }}" class="pull-right">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </h3>
                </div>

                <form action="/admin/sites/employees" method="POST">
                    @csrf

                    @foreach ($sites as $site)
                        <div class="box box-danger">
                            <div class="box-header">
                                <h4>
                                    {{ $site->name }}
                                    <span class="badge bg-red">{{ $site->employees->count() }}</span>
                                    <a href="{{ route('admin.sites.edit', $site->id) }}" class="pull-right text-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </h4>
                            </div>
                            @if ($site->employees->count() > 0)

                                <?php $count = $site->employees->count() == 0 ? 0 : ceil($site->employees->count() / 2) ?>

                                <div class="box-body">
                                    <div class="row">
                                        @foreach ($site->employees->chunk($count) as $chunk)
                                            <div class="col-sm-6">
                                                @foreach ($chunk as $employee)
                                                     <employee-check-box :employee="{{ $employee }}" style="border-top: solid 1px #ccc"
                                                    >,
                                                        {{ optional($employee->project)->name }} -
                                                        {{ optional($employee->position)->name }}
                                                    </employee-check-box>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <div class="col-sm-4 col-xs-7" style="position: fixed; bottom: 35%; right: 30px; padding: 15px ;  background-color: whitesmoke; border: darkgray; border-style: solid; border-width: thin;">
                        <div class="input-group">
                            {{ Form::select('site', $sites->pluck('name', 'id'), null, ['class' => 'form-control']) }}
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

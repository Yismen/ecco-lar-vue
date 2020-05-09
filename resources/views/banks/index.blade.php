@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Banks', 'page_description'=>'Banks Management'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                @include('banks.create')
                <div class="box box-primary">
                    
                    <div class="box-header with-border"><h3>Banks List</h3></div>

                    <div class="box-body">


                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="col-xs-2">
                                            Edit
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banks as $bank)
                                        <tr>
                                            <td>{{ $bank->name }}</td>
                                            <td>
                                                <a href="/admin/banks/{{ $bank->id }}/edit"><i class="fa fa-edit"></i> Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer"></div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
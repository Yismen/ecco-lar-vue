@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Sources', 'page_description'=>'Details.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                   <div class="box-header with-border">
                       <h4>
                           Project - {{ $project->name }}
                           <a href="{{ route('admin.projects.index') }}" class="pull-right" title="Back to List of Projects">
                                <i class="fa fa-home"></i>
                            </a>
                        </h4>

                       <div class="box-body">
                           <table class="table">
                               <tbody>
                                    <tr>
                                        <th class="text-right">Employees Count</th>
                                        <td class="text-left">{{ $project->employees->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-right">Client</th>
                                        <td class="text-left">
                                            <a href="{{ route('admin.clients.index') }}" target="__client">
                                                {{ optional($project->client)->name }}
                                            </a>    
                                        </td>
                                    </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush

@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Birthdays', 'page_description'=>"Birthdays"])

@section('content')
    @php
        $date = (new \Carbon\Carbon)->format('m-d');
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-info">
                    <div class="box-header">
                        <h4>{{ $title }}</h4>
                    </div>
                    {{-- .box-header --}}
                    <div class="box-body">
                        @if ($employees->count() > 0)
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date / Age</th>
                                        <th>Photo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr class="{{ $employee->date_of_birth->format('m-d') < $date ? 'bg-warning' : '' }}">
                                            <td>
                                                <a href="{{ route('admin.employees.show', $employee->id) }}" target="_employee">{{ $employee->full_name }}</a>
                                            </td>
                                            <td>
                                                {{ $employee->date_of_birth->format('M-d-Y') }}/
                                                {{ $employee->date_of_birth->age }} Years Old.
                                            </td>
                                            <td>
                                                @if (file_exists($employee->photo))
                                                    <a href="{{ asset($employee->photo) }}" target="_employee">
                                                        <img src="{{ asset($employee->photo) }}" style="max-height: 50px; max-width: 50px;"
                                                            class="profile-user-img img-responsive img-circle" alt="Image"
                                                        >
                                                    </a>
                                                @else
                                                    <img src="http://placehold.it/300x300" style="max-height: 50px; max-width: 50px;"
                                                        class="profile-user-img img-responsive img-circle" alt="Image"
                                                    >
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque sint, cumque ad, eos exercitationem dicta fuga sequi voluptate, iste nisi mollitia alias non, minus nemo repellat obcaecati magnam. Ullam, animi?
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop


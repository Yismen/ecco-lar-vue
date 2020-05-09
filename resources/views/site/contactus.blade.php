@extends('layouts.main')

@section('content')
    <br>
	<div class="container-fluid">

        <!-- Content Row -->

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <!-- Contact Details Column -->
            @include('site.partials.contact')

        </div>
        <!-- /.row -->
        <div class="row">
            <!-- Map Column -->
            <div class="">
                <!-- Embedded Google Map -->
                <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/d/embed?mid=zN5RxWZp6IA4.ka5jLO1jL6Ug"></iframe>
            </div>
        </div>
        <!-- /.row -->
    </div>
@stop

@push('scripts')
	
@endpush
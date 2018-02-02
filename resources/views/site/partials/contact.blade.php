<div class="col-md-4 col-md-push-8">
    <img class="img-circle img-responsive img-center" src="https://images.unsplash.com/photo-1431910078401-c3f7e61b1d5c?q=80&fm=jpg&s=bc04cdb20a18b6b037858b9a87f36d75" alt="" width="70%">
    <hr>
    <h3>Dainsys</h3>
    <p>
        Calle Eladio Corniel # 10, Apt. 8-C<br>Santiago, Dominican Republic<br>
    </p>
    <p><i class="fa fa-phone"></i> 
        <abbr title="Phone">P</abbr>: (829) 521 3304</p>
    <p><i class="fa fa-envelope-o"></i> 
        <abbr title="Email">E</abbr>: <a href="mailto:yismen.jorge@gmail.com">yismen.jorge@gmail.com</a>
    </p>
    <p><i class="fa fa-clock-o"></i> 
        <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM</p>
    <ul class="list-unstyled list-inline list-social-icons">
        <li>
            <a href="https://www.facebook.com/yismen.jorge32" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
        </li>
        <li>
            <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
        </li>
        <li>
            <a href="https://twitter.com/@Yismen" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a>
        </li>
        <li>
            <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
        </li>
    </ul>
    <a href="{{ route('faq') }}">Frequently Asked Questions</a>
</div>
<div class="col-md-8 col-md-pull-4 well">
    <h3>Leave us a Message <i class="fa fa-envelope"></i></h3>
    {!! Form::open(['route' => 'site_messages.store', 'method' => 'post', 'name' => "sentMessage", 'id'=>"sentMessage", 'novalidate'=> '', 'autocomplete'=>"off"]) !!}

        {{-- Display Errors --}}
        @if( $errors->any() )
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        {{-- /. Errors --}}

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : null }}">
                    {!! Form::label('customer_name', 'Your Name:', ['class'=>'']) !!}
                    {!! Form::input('text', 'customer_name', null, ['class'=>'form-control', 'placeholder'=>'Your Name']) !!}
                </div>
                <!-- /. Your Name: -->

                <div class="form-group {{ $errors->has('phone') ? 'has-error' : null }}">
                    {!! Form::label('phone', 'Your Phone Number:', ['class'=>'']) !!}
                    {!! Form::input('phone', 'phone', null, ['class'=>'form-control', 'placeholder'=>'Your Phone Number']) !!}
                </div>
                <!-- /. Your Phone Number -->

                <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
                    {!! Form::label('email', 'Your Email Address:', ['class'=>'']) !!}
                    {!! Form::input('email', 'email', null, ['class'=>'form-control', 'placeholder'=>'Your Email Address']) !!}
                </div>
                <!-- /. Your Email Address -->

                <div class="form-group {{ $errors->has('contact_types_id') ? 'has-error' : null }}">
                    {!! Form::label('contact_types_id', 'Message About:', ['class'=>'']) !!}
                    {!! Form::select('contact_types_id', App\ContactType::pluck('contact_type', 'id'), null, ['class'=>'form-control', 'placeholder'=>'Message About']) !!}
                </div>
                <!-- /. Message About -->
            </div>
            <div class="col-sm-6">

                <div class="form-group {{ $errors->has('message') ? 'has-error' : null }}">
                    {!! Form::label('message', 'Your Message:', ['class'=>'']) !!}
                    {!! Form::textarea('message', null, ['class'=>'form-control', 'placeholder'=>'Your Message']) !!}
                </div>
                <!-- /. Your Message -->
                
            </div>
        </div>

        <div id="success"></div>
        <!-- For success/fail messages -->
        <button type="submit" class="btn btn-primary">Send Message</button>
    
    {!! Form::close() !!}
</div>
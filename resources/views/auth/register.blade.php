@extends('layouts.default') 
@section('content')
<section>
    <div class="container">
        <div class="row align-items-center justify-content-center pt-5 mb-4">
            <h6 class="col-8">Registering on Gunthy is the first step toward creating an account. <br/>
                Once your email is confirmed,
                you'll need to complete your profile and verify your identity before you can begin trading.
            </h6>
        </div>
        <div class="row align-items-center justify-content-center mb-4">
            <div class="col-8">
                <div class="d-flex">
                    <div class="col">
                        <div class="card card-form" style="width: 22rem;">
                            <!--Card content-->
                            <div class="card-body rounded-top bg-dark-2">

                                <h3 class="font-weight-bold text-center text-uppercase text-white mt-4">{{ trans('titles.register') }}</h3>

                                <!-- Form -->
                                {!! Form::open(['route' => 'register', 'id' => 'register', 'role' => 'form', 'method' => 'POST'] ) !!}

                                    {{ csrf_field() }}

                                    <!-- user name -->
                                    <div class="md-form">
                                        <i class="far fa-user prefix text-white"></i>
                                        {!! Form::text('name', null, array('id' => 'name', 'class' => 'form-control text-white')) !!}
                                        {!! Form::label('name', trans('auth.name') , array('class' => 'text-white')); !!}
                                        @if ($errors->has('name'))
                                        <span class="form-text text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <!-- First name -->
                                    <div class="md-form">
                                        <i class="far fa-user prefix text-white"></i>
                                        {!! Form::text('first_name', null, array('id' => 'first_name', 'class' => 'form-control text-white', 'pattern' => '[A-Z, ,a-z]*')) !!}
                                        {!! Form::label('first_name', trans('auth.first_name') , array('class' => 'text-white')); !!}
                                        @if ($errors->has('first_name'))
                                        <span class="form-text text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                    <!-- Last name -->
                                    <div class="md-form">
                                        <i class="far fa-hand-point-right prefix text-white"></i>
                                        {!! Form::text('last_name', null, array('id' => 'last_name', 'class' => 'form-control text-white', 'pattern' => '[A-Z, ,a-z]*')) !!}
                                        {!! Form::label('last_name', trans('auth.last_name') , array('class' => 'text-white')); !!}
                                        @if ($errors->has('last_name'))
                                        <span class="form-text text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                    
                                    <!-- E-mail -->
                                    <div class="md-form mt-0">
                                        <i class="far fa-envelope prefix text-white"></i>
                                        {!! Form::email('email', null, array('id' => 'email', 'class' => 'form-control text-white')) !!}
                                        {!! Form::label('email', trans('auth.email') , array('class' => 'text-white')); !!}
                                        @if ($errors->has('email'))
                                        <span class="form-text text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <!-- Password -->
                                    <div class="md-form">
                                        <i class="fas fa-phone prefix text-white"></i>
                                        {!! Form::text('phone', null, array('id' => 'phone', 'class' => 'form-control text-white')) !!}
                                        {!! Form::label('phone', trans('auth.phone') , array('class' => 'text-white')); !!}
                                        @if ($errors->has('phone'))
                                        <span class="form-text text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>

                                    <div class="md-form">
                                        <i class="fas fa-fingerprint prefix text-white"></i>
                                        {!! Form::password('password', array('id' => 'password', 'class' => 'form-control text-white')) !!}
                                        {!! Form::label('password', trans('auth.password') , array('class' => 'text-white')); !!}
                                        @if ($errors->has('password'))
                                        <span class="form-text text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="md-form">
                                        <i class="fas fa-check prefix text-white"></i>
                                        {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control text-white')) !!}
                                        {!! Form::label('password_confirmation', trans('auth.confirmPassword') , array('class' => 'text-white')); !!}
                                        @if ($errors->has('password_confirmation'))
                                        <span class="form-text text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>

                                    <!-- Default unchecked -->
                                    <div class=" md-form custom-control custom-checkbox">
                                        {!! Form::checkbox('accepted', null, null, array('id'=> 'accepted', 'class' => 'custom-control-input')) !!}
                                        {!! Form::label('accepted', trans('auth.accepted'), array('class' => 'custom-control-label text-white')) !!}
                                        @if ($errors->has('accepted'))
                                        <span class="form-text text-danger">{{ $errors->first('accepted') }}</span>
                                        @endif
                                    </div>
                                    @if(config('settings.reCaptchStatus'))
                                    <div class=" md-form d-flex flex-column align-items-center">
                                        <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                                    </div>
                                    @endif

                                    {!! Form::button(trans('auth.register'), array('class' => 'btn btn-elegant btn-lg btn-block','type' => 'submit','id' => 'submit')) !!}

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col flex-auto">
                        <p>
                            The email address you provide will become your Gunthy ID and will be used for all future communications,
                            including account recovery. Protect your email account like you would your Gunthy account.
                            Sign-ups using throwaway email addresses will be rejected.
                        </p>
                        <p>
                            Your password must be at least 8 characters long,
                            but it is HIGHLY recommended that you choose a random,
                            alphanumeric password of at least 32 characters.
                        </p>
                        <p>
                            EVER use a password for an exchange that you use ANYWHERE else,
                            especially for the email address you sign up with
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</section>
@endsection

@section('script')
@if(config('settings.reCaptchStatus'))
{!! HTML::script('https://www.google.com/recaptcha/api.js', array('type' => 'text/javascript')) !!}
@endif
@endsection
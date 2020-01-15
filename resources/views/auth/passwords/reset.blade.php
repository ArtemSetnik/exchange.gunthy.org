@extends('layouts.default')

@section('title')
    Reset Password
@endsection

@section('content')

    <div class="card card-form ml-auto mr-auto  bg-dark-2 mt-5 mb-3" style="width: 22rem;">
    
        <!--Card content-->
        <div class="card-body rounded-top bg-dark-2">
    
            <h3 class="font-weight-bold text-center text-uppercase text-white mt-4">{{ trans('titles.resetPword') }}</h3>
    
            <!-- Form -->
            {!! Form::open(['route' => 'password.request', 'method' => 'POST', 'class' => 'auth-form', 'id' => 'reset']) !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <!-- email -->
                <div class="md-form">
                    <i class="far fa-envelope prefix text-white"></i>
                    {!! Form::email('email', $email or old('email'), array('id' => 'email', 'class' => 'form-control text-white', )) !!}
                    {!! Form::label('email', trans('auth.email') , array('class' => 'text-white')); !!}
                    @if ($errors->has('email'))
                    <span class="form-text text-danger">{{ $errors->first('email') }}</span>
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

                @if(config('settings.reCaptchStatus'))
                <div class=" md-form d-flex flex-column align-items-center">
                    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                    @if ($errors->has('captcha'))
                    <span class="form-text text-danger">{{ $errors->first('captcha') }}</span>
                    @endif
                </div>
                @endif

                {!! Form::button(trans('auth.resetPassword'), array('class' => 'btn btn-elegant btn-lg btn-block','type' => 'submit','id' => 'submit')) !!}
            {!! Form::close() !!}
    
            <hr class="elegant-color">

            <div class="d-flex justify-content-between">

                {!! HTML::link(url('/register'), trans('auth.register'), array('id' => 'register', 'class' => 'left')) !!}
                {!! HTML::link(url('/login'), trans('auth.login'), array('id' => 'login', 'class' => 'right')) !!}

            </div>
    
        </div>
    
    </div>

@endsection

@section('script')
@if(config('settings.reCaptchStatus'))
    {!! HTML::script('https://www.google.com/recaptcha/api.js', array('type' => 'text/javascript')) !!}
@endif
@endsection
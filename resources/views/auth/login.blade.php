@extends('layouts.default') 
@section('title') {{ trans('auth.loginPageTitle') }}
@endsection
 
@section('content')
<section>
    <div class="card card-form ml-auto mr-auto  bg-dark-2 mt-5" style="width: 22rem;">
    
        <!--Card content-->
        <div class="card-body rounded-top bg-dark-2">
    
            <h3 class="font-weight-bold text-center text-uppercase text-white mt-4">{{ trans('titles.loginHeader') }}</h3>
    
            <!-- Form -->
            {!! Form::open(['url' => 'login', 'method' => 'POST', 'class' => 'pb-3 px-2', 'id' => 'login', 'role' => 'form']) !!}
                {{ csrf_field() }}
                <!-- email -->
                <div class="md-form">
                    <i class="far fa-envelope prefix text-white"></i>
                    {!! Form::email('email', null, array('id' => 'email', 'class' => 'form-control text-white')) !!}
                    {!! Form::label('email', trans('auth.email') , array('class' => 'text-white')); !!}
                    @if ($errors->has('email'))
                    <span class="form-text">{{ trans('auth.emailLoginError') }}</span>
                    @endif
                </div>
                <!-- password -->
                <div class="md-form">
                    <i class="far fa-star prefix text-white"></i>
                    {!! Form::password('password', array('id' => 'password', 'class' => 'form-control text-white')) !!}
                    {!! Form::label('password', trans('auth.password') , array('class' => 'text-white')); !!}
                    @if ($errors->has('password'))
                    <span class="form-text">{{ trans('auth.pwLoginError') }}</span>
                    @endif
                </div>
                {{-- <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                        {!! Form::checkbox('remember', 'remember', null, ['id' => 'remember', 'class' => 'mdl-checkbox__input', old('remember') ? 'checked' : '']); !!}
                        <span class="mdl-checkbox__label">{{ trans('auth.rememberMe') }}</span>
                </label> --}}
                {!! Form::button(trans('auth.login'), array('class' => 'btn btn-elegant btn-lg btn-block','type' => 'submit','id' => 'submit')) !!}
            {!! Form::close() !!}
    
            <hr class="elegant-color">

            <div class="d-flex justify-content-between">

                {!! HTML::link(route('password.request'), trans('auth.forgot'), array('id' => 'forgot', 'class' => 'left')) !!}
                {!! HTML::link(url('/register'), trans('auth.register'), array('id' => 'register', 'class' => 'right')) !!}

            </div>
    
        </div>
    
    </div>
</section>

@endsection
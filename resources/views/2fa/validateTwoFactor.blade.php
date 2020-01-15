@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="content-header">Google 2FA</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3 class="text-center">please enter google 2fa token</h3>
            <div class="text-center ml-auto mr-auto mt-4 mb-4" style="width: 30rem;">
                {{ Form::open(['url' => 'google2fa/validate']) }}
                    {{ csrf_field() }}
                    <div class="d-flex align-items-center justifiy-content-center">
                        <div class="md-form input-group mb-4">
                            {!! Form::text('google_2fa_token', null, array('id' => 'google_2fa_token', 'class' => 'form-control text-white')) !!}
                            {!! Form::label('google_2fa_token', 'One-Time Password' , array('class' => 'text-white')); !!}
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:11rem;">
                            <i class="fas fa-mobile-alt"></i>
                            Validate
                        </button>
                    </div>
                    
                    @if ($errors->has('google_2fa_token'))
                    <span class="form-text text-danger">{{ $errors->first('google_2fa_token') }}</span>
                    @endif
                    
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
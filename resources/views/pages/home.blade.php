@extends('layouts.default') 
@section('content')
<div class="container home">
    <div class="mt-5">
        <h1 class="text-center text-dark">WELCOME TO Gunthy</h1>
        <p class="text-primary text-center">We are a digital asset exchange offering maximum security and advanced trading features.</p>
    </div>

    <div class="home-body">
        <h2 class="text-center">Trade securely on the world's most active digital asset exchange.</h2>
        
        @if (!Auth::user())
        <p class="text-center"><a href="{{ Route('register') }}" class="btn btn-primary">Create Your Account</a></p>
        <p class="login-link p-2 text-center text-dark">Already a member? <a href="{{ Route('login') }}">Sign in.</a></p>
        @endif
    </div>
    <div class="row p-2 home-footer">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <h5>Keeping hackers out.</h5>
            <p class="text-white-50">The vast majority of customer deposits are stored offline in air-gapped cold storage. We only keep enough online to facilitate active trading, which greatly minimizes risk and exposure.</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <h5>Monitoring around the clock.</h5>
            <p class="text-white-50">Our auditing programs monitor exchange activity 24/7/365. Their job is to report and block any suspicious activity before it becomes a problem.</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <h5>Your funds are yours. Period.</h5>
            <p class="text-white-50">Any funds you put into the exchange are only used to facilitate trading through your account. Unlike banks, we do not operate on fractional reserves.</p>
        </div>
    </div>
</div>
@endsection
 
@section('head')
<link href="{{ asset('css/pages/home.css') }}" rel="stylesheet">
@endsection
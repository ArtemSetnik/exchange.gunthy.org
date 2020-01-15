@extends('layouts.default')

@section('title')
	{{ trans('titles.activation') }}
@endsection

@section('content')
<div class="container">
	<div class="card mt-5 mb-5">
		<div class="card-body elegant-color white-text rounded-bottom">
	
			<!-- Social shares button -->
			<a class="activator waves-effect mr-4"><i class="fas fa-share-alt white-text"></i></a>
			<!-- Title -->
			<h4 class="card-title">{{ trans('auth.confirmation') }}</h4>
			<hr class="hr-light">
			<!-- Text -->
			<p>{{ trans('auth.anEmailWasSent',['email' => $email, 'date' => $date ] ) }}</p>
			<p>{{ trans('auth.clickInEmail') }}</p>
			<p><a href='/activation' class="mdl-button mdl-js-button mdl-js-ripple-effect center mdl-color--primary mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-2">{{ trans('auth.clickHereResend') }}</a></p>
			<!-- Link -->
			{!! HTML::link(url('/logout'), trans('auth.logout'), array('id' => 'logout', 'class' => 'white-text d-flex justify-content-end')) !!}
	
		</div>
	</div>
</div>
@endsection
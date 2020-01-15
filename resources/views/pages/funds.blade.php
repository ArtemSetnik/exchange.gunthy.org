@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="mt-3 container">
		<div class="row">


            <div class="col">
                <div class="bg-dark-2 blockquote bq-primary text-light d-flex align-items-center">
                    <div class="mr-5">Deposit</div>
                </div>

                <div class="card card-form">
                    <!--Card content-->
                    <div class="card-body bg-dark-2">
                        <h5 class="text-white"><span class="text-uppercase">Sell GUNTHY</span><span>(Market)</span></h5>
                        <div class="grey-text d-flex justify-content-end"><span>Deposit GUNTHY</span></div>
                        <div class="grey-text">You have: <span>0.10993499 GUNTHY</span></div>
                        <div class="grey-text">Lowest Ask: <span>0.10993499 GUNTHY</span></div>
                        <hr class="success-color-dark ml-n2 mr-n2"/>

                        {{-- <h3 class="font-weight-bold text-center text-uppercase text-white mt-4">{{ trans('titles.loginHeader') }}</h3> --}}

                        <!-- Form -->
                        {!! Form::open(['url' => 'login', 'method' => 'POST', 'class' => 'pb-3 px-2', 'id' => 'login', 'role' => 'form']) !!}
                            {{ csrf_field() }}
                            <!-- email -->
                            <div class="md-form input-group mb-4">
                                {!! Form::text('sell_market_price', null, array('id' => 'sell_market_price', 'class' => 'form-control text-white')) !!}
                                {!! Form::label('sell_market_price', 'price' , array('class' => 'text-white')); !!}
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon">BTC</span>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                            <span class="form-text">{{ trans('auth.emailLoginError') }}</span>
                            @endif
                            <div class="md-form input-group mb-4">
                                {!! Form::text('sell_market_amount', null, array('id' => 'sell_market_amount', 'class' => 'form-control text-white')) !!}
                                {!! Form::label('sell_market_amount', 'amount' , array('class' => 'text-white')); !!}
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon">GUNTHY</span>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                            <span class="form-text">{{ trans('auth.emailLoginError') }}</span>
                            @endif
                            <div class="md-form input-group mb-4 d-flex">
                                <div class="grey-text">Total</div>
                                <div class="ml-auto grey-text">0.00944343</div>
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon pt-0 pb-0">BTC</span>
                                </div>
                            </div>
                            {!! Form::button('SELL', array('class' => 'btn btn-elegant btn-lg btn-block','type' => 'submit','id' => 'submit')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- Card -->
            </div>



            <div class="col">
                <div class="bg-dark-2 blockquote bq-primary text-light d-flex align-items-center">
                    <div class="mr-5">Withdraw</div>
                    
                </div>
                <div class="card card-form">
                    <!--Card content-->
                    <div class="card-body bg-dark-2">
                        <h5 class="text-white"><span class="text-uppercase">Sell GUNTHY</span><span>(Market)</span></h5>
                        <div class="grey-text d-flex justify-content-end"><span>Deposit GUNTHY</span></div>
                        <div class="grey-text">You have: <span>0.10993499 GUNTHY</span></div>
                        <div class="grey-text">Lowest Ask: <span>0.10993499 GUNTHY</span></div>
                        <hr class="success-color-dark ml-n2 mr-n2"/>

                        {{-- <h3 class="font-weight-bold text-center text-uppercase text-white mt-4">{{ trans('titles.loginHeader') }}</h3> --}}

                        <!-- Form -->
                        {!! Form::open(['url' => 'login', 'method' => 'POST', 'class' => 'pb-3 px-2', 'id' => 'login', 'role' => 'form']) !!}
                            {{ csrf_field() }}
                            <!-- email -->
                            <div class="md-form input-group mb-4">
                                {!! Form::text('sell_market_price', null, array('id' => 'sell_market_price', 'class' => 'form-control text-white')) !!}
                                {!! Form::label('sell_market_price', 'price' , array('class' => 'text-white')); !!}
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon">BTC</span>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                            <span class="form-text">{{ trans('auth.emailLoginError') }}</span>
                            @endif
                            <div class="md-form input-group mb-4">
                                {!! Form::text('sell_market_amount', null, array('id' => 'sell_market_amount', 'class' => 'form-control text-white')) !!}
                                {!! Form::label('sell_market_amount', 'amount' , array('class' => 'text-white')); !!}
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon">GUNTHY</span>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                            <span class="form-text">{{ trans('auth.emailLoginError') }}</span>
                            @endif
                            <div class="md-form input-group mb-4 d-flex">
                                <div class="grey-text">fee(0.05%)</div>
                                <div class="ml-auto grey-text">0.00944343</div>
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon pt-0 pb-0">BTC</span>
                                </div>
                            </div>
                            <div class="md-form input-group mb-4 d-flex">
                                <div class="grey-text">Total</div>
                                <div class="ml-auto grey-text">0.00944343</div>
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon pt-0 pb-0">BTC</span>
                                </div>
                            </div>
                            {!! Form::button('SELL', array('class' => 'btn btn-elegant btn-lg btn-block','type' => 'submit','id' => 'submit')) !!}
                        {!! Form::close() !!}

                    </div>

                </div>
                <!-- Card -->
            </div>
        </div>
		<table id="orderHistory" width="100%" class="table table-striped"></table>
	</div>
</div>
@endsection
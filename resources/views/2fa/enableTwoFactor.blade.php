@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="content-header">2FA Secret Key</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3 class="text-center">Open up your 2FA mobile app and scan the following QR barcode:</h3>
            <p class="text-center">
                <img alt="Image of QR barcode" src="{{ $image }}" />
            </p>    
            <p class="text-center">
                If your 2FA mobile app does not support QR barcodes, 
                enter in the following number: <code>{{ $secret }}</code>
            </p>
            <div class="text-center mt-4 mb-4">
                {{ Form::open(['url' => 'google2fa/confirmEnable']) }}
                    {{ csrf_field() }}
                    {!! Form::button('Save & Confirm', array('class' => 'btn btn-elegant btn-lg','type' => 'submit','id' => 'submit')) !!}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
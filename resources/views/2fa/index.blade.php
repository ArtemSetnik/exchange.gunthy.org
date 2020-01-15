@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="content-header">Two Factor Authentication (2FA)</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Two Factor Authentication @if (Auth::user()->enabledGoogle2fa()) Enabled @else Disabled @endif </h3>
            <div>
                For extra account security, we strongly recommend you enable two-factor authentication (2FA). Gunthy uses Google Authenticator for 2FA.
            </div>
        </div>
        <div class="col">
            <h2>Enable Two-Factor Authentication</h2>

            @if (Auth::user()->enabledGoogle2fa())

            {{ Form::open(['url' => 'google2fa/disable', 'id' => 'formGoogle2fa', 'method' => 'get', 'class' => 'pb-3 px-2']) }}
                <div class="md-form input-group mb-4">
                    {!! Form::select('2fa_type', array_pluck($types, 'name', 'key'), 'google', ['class' => 'bg-dark-1 form-control form-control-md']) !!}
                </div>
                <div class="md-form input-group mb-4">
                    <button type="submit" id="btnSubmit" style="display: none;"></button>
                    {!! Form::button('Disable 2FA', array('class' => 'btn btn-elegant btn-lg btn-block','type' => 'button','id' => 'submit')) !!}
                </div>
            {{ Form::close() }}

            @else

            {{ Form::open(['url' => 'google2fa/enable', 'id' => 'formGoogle2fa', 'class' => 'pb-3 px-2']) }}
                {{ csrf_field() }}
                <div class="md-form input-group mb-4">
                    <button type="submit" id="btnSubmit" style="display: none;"></button>
                    {!! Form::select('2fa_type', array_pluck($types, 'name', 'key'), 'google', ['class' => 'bg-dark-1 form-control form-control-md']) !!}
                </div>
                <div class="md-form input-group mb-4">
                    {!! Form::button('Enable 2FA', array('class' => 'btn btn-elegant btn-lg btn-block','type' => 'button','id' => 'submit')) !!}
                </div>
            {{ Form::close() }}

            @endif

        </div>
    </div>
</div>

<div class="modal fade right" id="modalRelatedContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header bg-dark-2">
                <p class="heading">Notice</p>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body bg-dark-1">
        
                <div class="row">
                    <div class="col">
                        <p class="text-white"><strong>Do you really need to enable?</strong></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button id="btnOK" class="btn btn-elegant">Yes</button>
                <button data-dismiss="modal" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
@endsection

@section('script')
<script>
    $('#submit').click(function(event){
        $('#modalRelatedContent').modal('show');
    });
    $('#btnOK').click(function(){
        $('#btnSubmit').click();
    })
</script>
@endsection
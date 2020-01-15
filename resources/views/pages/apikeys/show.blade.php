 @extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="content-header">Gunthy API Keys</h2>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex">
                <div class="flex-grow-1">
                    <div class="ml-auto" style="width:200px">
                        <div class="md-form input-group">
                            {!! Form::text('api_name', null, array('id' => 'apiName', 'required', 'class' => 'form-control text-white-50 price-value')) !!}
                            {!! Form::label('apiName', 'Api Name' , array('class' => 'text-white')); !!}
                        </div>
                        @if ($errors->has('api_name'))
                            <span class="form-text text-danger">{{ $errors->first('api_name') }}</span>
                        @endif
                    </div>
                </div>
                <div>
                    {!! Form::button('New Api Key', array('class' => 'btn btn-elegant','type' => 'submit','id' => 'btnNewApi')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table id="apikeyTable" width="100%" class="table table-striped"></table>
            </div>
        </div>
    </div>

    <div style="display: none">
            {!! Form::open(['id' => 'ajaxForm', 'role' => 'form', 'method' => 'POST'] ) !!}
            {!! Form::close() !!}
    </div>

    @if (!empty($api))
        <!--Modal: modalRelatedContent-->
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
                            <p class="text-white"><strong>Created Api Key</strong></p>
                            <p class=" text-white-50">The secret has only shown once now so please keep the secret key securitly</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="md-form input-group mb-5">
                                {!! Form::text(null, $api['key'], array('id' => 'apiKey', 'readonly', 'class' => 'form-control text-white-50 price-value')) !!}
                                {!! Form::label('apiKey', 'API Key' , array('class' => 'text-white')); !!}
                            </div>
                            <div class="md-form input-group mb-5">
                                {!! Form::text(null, $api['secret'], array('id' => 'apiSecret', 'readonly', 'class' => 'form-control text-white-50 price-value')) !!}
                                {!! Form::label('apiSecret', 'Secret' , array('class' => 'text-white')); !!}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!--/.Content-->
            </div>
        </div>

    @endif
@endsection
 
@section('head')
<link href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('css/addons/datatables.css') }}" rel="stylesheet">
<link href="{{ asset('css/addons/datatables-select.css') }}" rel="stylesheet">
@endsection

@section('script')

    <script type="text/javascript" src="{{ asset('js/addons/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/addons/datatables-select.js') }}"></script>
    <script>
        @if (!empty($api))
            $('#modalRelatedContent').modal('show');
        @endif
        var ajaxForm = $('#ajaxForm');
        var apiKeyTable = $('#apikeyTable').dataTable( {
            "sDom": 't',
			"stateSave": true,
			"paging":   false,
			"info":     false,
			"bDestroy" : true,
			"bAutoWidth" : true,
			"sScrollY" : "200",
			"sScrollX" : "100%",
			"bScrollCollapse" : true,
			// "bSort" : true,
			"sPaginationType" : "full_numbers",
			"iDisplayLength" : 25,
			"bLengthChange" : false,
            data: {!! json_encode($keys) !!},
			order: [ 0, 'desc' ],
			columns: [
                // {
                //     name: 'created_at', data: 'created_at', "visible": false
                // },
				{
					name: 'api_name', data: 'api_name', title: 'Name', searchable: false
				},
				{
					name: 'key', data: 'key', title: 'Key', searchable: false, orderable: false
				},
				{
					title: 'Controls', searchable: false, orderable: false, width: 100, mData: function (rowData, type, row, meta) {
                        return '<i class="fas fa-trash"></i>';
                    }, fnCreatedCell : function (element, celldata, rowdata, rowid) {
						$(element).click(function(){
                            ajaxForm.html('');
                            ajaxForm.append('{{ csrf_field() }}');
                            ajaxForm.attr('action', '{{ url("apikeys/deleteApikey") }}');
                            ajaxForm.append('<input type="hidden" name="api_id" value="' + rowdata.id + '"/>');
                            ajaxForm.submit();
						})
					}
				},
			]
		} );

        $('#btnNewApi').click(function(){
            ajaxForm.html('');
            ajaxForm.append('{{ csrf_field() }}');
            ajaxForm.append('<input type="hidden" value="' + $('#apiName').val() + '" name="api_name"/>');
            ajaxForm.attr('action', '{{ url("apikeys/generate") }}');
            ajaxForm.submit();
        })

    </script>
@endsection
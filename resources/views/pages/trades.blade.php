@extends('layouts.default') 
@section('content')
<div class="container-fluid exchange">
    <div class="mt-3 container">
        <div class="bg-dark-2 blockquote bq-primary text-light d-flex align-items-center">
            <div class="mr-5">Trade History</div>
            <div class="controls-order-history ml-5 d-flex align-items-center">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="onlyMyTrades" checked>
                    <label class="custom-control-label" for="onlyMyTrades">My Trades</label>
                </div>
            </div>
        </div>
        <table id="tradeHistory" width="100%" class="table table-striped"></table>
    </div>
</div>
@endsection
 
@section('head')
<link href="{{ asset('css/addons/datatables.css') }}" rel="stylesheet">
<link href="{{ asset('css/addons/datatables-select.css') }}" rel="stylesheet">
<link href="{{ asset('css/pages/orders.css') }}" rel="stylesheet">
@endsection
 
@section('script')
<script type="text/javascript" src="{{ asset('js/addons/datatables.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/datatables-select.js') }}"></script>
<script>
    $('.controls-order-history .order-side-btns').children().each((index, elem) => {
        $(elem).click(function(){
            $(this).parent().children().removeClass('active');
            $(this).addClass('active');
        })
    })

var table = $('#tradeHistory').dataTable( {
    "processing": true,
    "serverSide": true,
    "initComplete": function( settings, json ) {
        
    },
    lengthMenu: [10, 15, 25, 50],
    "ajax":{
        url :"{{ Route('api.myTrades') }}" + '?local_timezone_offset=' + local_timezone_offset, // json datasource
        type: "get",  // method  , by default get
        error: function(){  // error handling
            // $(".employee-grid-error").html("");
            // $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            // $("#employee-grid_processing").css("display","none");

        }
    },
    language: {
        info: "_START_ ~ _END_",
        infoEmpty: "0 / 0",
        infoFiltered: " / filtered _TOTAL_ of _MAX_"
    },
    columns: [
        {
            data: 'maker', name: 'maker', title: 'Type', searchable: true, orderable: true, mData: function (rowData, type, row, meta) {
                return rowData.maker || ''
            }
        },
        {
            data: 'price', name: 'price', title: 'Price', searchable: true, orderable: true, mData: function (rowData, type, row, meta) {
                return rowData.price || ''
            }
        },
        {
            data: 'quantity', name: 'quantity', title: 'Amount', searchable: true, mData: function (rowData, type, row, meta) {
                return rowData.quantity || '0'
            }
        },
        {
            data: 'value', title: 'Value', searchable: false, orderable: false, mData: function (rowData, type, row, meta) {
                return float2String(_.multiply(rowData.price, rowData.quantity)) || 0
            }
        },
        {
            title: 'Fee', searchable: false, orderable: false, mData: function (rowData, type, row, meta) {
                var fee = _.multiply(0.0005, rowData.quantity);
                fee = _.multiply(fee,rowData.price);
                return float2String(fee) || 0
            }
        },
        {
            title: 'Trade Time', name: 'trade_time', searchable: false, mData: function (rowData, type, row, meta) {
                return rowData.trade_time || 0
            }
        },
    ]
} );

$('#tradeHistory_wrapper .dataTables_filter').find('label').each(function () {
    $(this).parent().append($(this).children());
});
$('#tradeHistory_wrapper .dataTables_filter').find('input').each(function () {
    $('input').attr("placeholder", "Search");
    $('input').removeClass('form-control-sm');
});
$('#tradeHistory_wrapper .dataTables_filter').addClass('md-form');
$('#tradeHistory_wrapper .dataTables_filter').find('label').remove();

$('#onlyMyTrades').change(function(){
	changeURL();
})

function changeURL() {
	var url = "{{ Route('api.trades') }}" + '?local_timezone_offset=' + local_timezone_offset;
	if($('#onlyMyTrades')[0].checked) url = "{{ Route('api.myTrades') }}" + '?local_timezone_offset=' + local_timezone_offset;
	console.log(url);

	table.api().ajax.url( url ).load();
}

</script>
@endsection
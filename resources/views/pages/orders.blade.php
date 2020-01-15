@extends('layouts.default') 
@section('content')
<div class="container-fluid">
	<div class="mt-3 container">
		<div class="bg-dark-2 blockquote bq-primary text-light d-flex align-items-center">
			<div class="mr-5">Order History</div>
			<div class="controls-order-history ml-5 d-flex align-items-center">
				<div id="orderHistoryControl" class="btn-group ml-4 custom-radio-button-group" role="group" aria-label="Basic example">
					<button type="button" class="btn btn-primary btn-md active">All</button>
					<button type="button" class="btn btn-primary btn-md">Buy</button>
					<button type="button" class="btn btn-primary btn-md">Sell</button>
				</div>
			</div>
		</div>
		<table id="orderHistory" width="100%" class="table table-striped"></table>
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

var table = $('#orderHistory').dataTable( {
	"processing": true,
	"serverSide": true,
	"initComplete": function( settings, json ) {

	},
	lengthMenu: [10, 15, 25, 50],
	"ajax":{
		url :"{{ Route('api.ordersHistory') }}" + '?local_timezone_offset=' + local_timezone_offset, // json datasource
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
			data: 'currency_1', name: 'currency_1', title: 'Currency 1', searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
				return rowData.currency_1 || ''
			}
		},
		{
			data: 'currency_2', name: 'currency_2', title: 'Currency 2', searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
				return rowData.currency_2 || ''
			}
		},
		{
			data: 'order_side', name: 'order_side', title: 'Type', searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
				return formatOrderSide(rowData.order_side) || ''
			}
		},
		{
			data: 'price', name: 'price', title: 'Price', searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
				return rowData.price || ''
			}
		},
		{
			data: 'quantity', name: 'quantity', title: 'Amount', searchable: true, mData: function (rowData, type, row, meta) {
				return rowData.quantity || '0'
			}
		},
		{
			title: 'value', searchable: true, mData: function (rowData, type, row, meta) {
				// return $rootScope.changedDate(rowData['measure_time'])
				return float2String(_.multiply(rowData.quantity, rowData.price)) || 0
			}
		},
		{
			data: 'order_state', name: 'order_state', title: 'Order State', searchable: true, mData: function (rowData, type, row, meta) {
				return renderOrderState(rowData.order_state) || '0'
			}
		},
		{
			data: 'order_time', name: 'order_time', title: 'Order Time', searchable: true, mData: function (rowData, type, row, meta) {
				return rowData.order_time || '0'
			}
		},
	],
	responsive: {
		details: {
			renderer: function ( api, rowIdx, columns ) {
				var data = $.map( columns, function ( col, i ) {
					return col.hidden ?
						'<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
							'<td>'+col.title+':'+'</td> '+
							'<td>'+col.data+'</td>'+
						'</tr>' :
						'';
				} ).join('');

				return data ?
					$('<table/>').append( data ) :
					false;
			}
		}
	}
} );

$('#orderHistory_wrapper .dataTables_filter').find('label').each(function () {
	$(this).parent().append($(this).children());
});
$('#orderHistory_wrapper .dataTables_filter').find('input').each(function () {
	$('input').attr("placeholder", "Search");
	$('input').removeClass('form-control-sm');
});
$('#orderHistory_wrapper .dataTables_filter').addClass('md-form');
$('#orderHistory_wrapper .dataTables_filter').find('label').remove();

$('#onlyOpen').change(function(){
	changeURL();
})
$('#orderHistoryControl > button').click(function(){
	changeURL();
})

function changeURL() {
	var url = "{{ Route('api.ordersHistory') }}";
	url += '?local_timezone_offset=' + local_timezone_offset
	var activeLabel = $('#orderHistoryControl > button.active').text();
	var order_side;
	console.log(activeLabel);
	if(activeLabel == 'Buy') order_side = 'buy';
	else if(activeLabel == 'Sell') order_side = 'sell';
	if(order_side) url += '&order_side=' + order_side;
	console.log(url);

	table.api().ajax.url( url ).load();
}

</script>
@endsection
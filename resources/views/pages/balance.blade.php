@extends('layouts.default') 
@section('content')
<div class="container-fluid">
	<div class="mt-3 container">
		<div class="bg-dark-2 blockquote bq-primary text-light d-flex align-items-center">
			<div class="mr-5">Balances</div>
		</div>
		<table id="balanceList" width="100%" class="table table-striped"></table>
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

$('#balanceList').DataTable( {
	"processing": true,
	"serverSide": true,
	"initComplete": function( settings, json ) {
		
	},
	lengthMenu: [10, 15, 25, 50],
	"ajax":{
		url :"{{ Route('api.openOrders') }}", // json datasource
		type: "get",  // method  , by default get
		error: function(){  // error handling
			// $(".employee-grid-error").html("");
			// $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
			// $("#employee-grid_processing").css("display","none");

		}
	},
	language: {
		info: "_START_ ~ _END_ / ",
		infoEmpty: "0 / 0",
		infoFiltered: "filtered _TOTAL_ of _MAX_"
	},
	columns: [
		{
			data: 'order_type', title: 'Type', searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
				return rowData.order_type || ''
			}
		},
		{
			data: 'price', title: 'Price', searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
				return rowData.price || ''
			}
		},
		{
			data: 'amount', title: 'Amount', searchable: true, mData: function (rowData, type, row, meta) {
				return rowData.amount || '0'
			}
		},
		{
			data: 'value', title: 'Value', searchable: true, mData: function (rowData, type, row, meta) {
				// return $rootScope.changedDate(rowData['measure_time'])
				return rowData.value || 0
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

$('#balanceList_wrapper .dataTables_filter').find('label').each(function () {
	$(this).parent().append($(this).children());
});
$('#balanceList_wrapper .dataTables_filter').find('input').each(function () {
	$('input').attr("placeholder", "Search");
	$('input').removeClass('form-control-sm');
});
$('#balanceList_wrapper .dataTables_filter').addClass('md-form');
$('#balanceList_wrapper .dataTables_filter').find('label').remove();

</script>
@endsection
@extends('layouts.default') 
@section('content')
<div class="container-fluid exchange">
	<div class="row mt-3">
		<div class="col col-9">
			<div class="blockquote bq-primary bg-dark-2 text-light">
				<div class="row">
					<div class="col">
						<h2>GUNTHY EXCHANGE</h2>
						<div>{{ $currency_1 . " / " . $currency_2 }}</div>
					</div>
					<div class="site-24hr-info mr-3 border-dark-1">
						<div class="border-dark-1">
							<div class="border-dark-1">
								<span>Last Price</span>
								<span class="number last">0</span>
							</div>
							<div class="border-dark-1">
								<span>24hr Change</span>
								<span class="number change">0 %</span>
							</div>
							<div class="border-dark-1">
								<span>24hr High</span>
								<span class="number high">0</span>
							</div>
							<div>
								<span>24hr Low</span>
								<span class="number low">0</span>
							</div>
						</div>
						<div>
							<div>24hr Volume: </div>
							<div><span class="number vol-btc">0</span> {{ $currency_2 }} / <span class="number vol-currency">0</span> {{ $currency_1 }}</div>
						</div>
					</div>
				</div>
			</div>

			<div class="p-3 mt-3 col border border-dark-1" >
				<canvas id="lineChart" style = "display:none;"></canvas>
				<!-- TradingView Widget BEGIN -->
				<div class="tradingview-widget-container" style = "min-height:400px;">
					<div id="tradingview_823c3" style = "min-height:400px;height:500px;"></div>

				</div>
				<!-- TradingView Widget END -->
			</div>

			<div class="p-3 mt-3">
				<div class="row exchange-order">
					<div class="col">
						<!-- Card -->
						<div class="card card-form">

							<!--Card content-->
							<div class="card-body bg-dark-2 p-2">
								<h5 class="text-white"><span class="text-uppercase">Buy GUNTHY</span><span>(Market)</span></h5>
								<div class="grey-text d-flex justify-content-end"><span>Deposit BTC</span></div>
								@if (Auth::user()) <div class="grey-text">You have: <span class="balance-btc">0</span> BTC</div> @endif
								<div class="grey-text">Lowest Ask: <span class="lowest-ask">0</span> BTC</div>
								<hr class="success-color-dark ml-n2 mr-n2" /> {{--
								<h3 class="font-weight-bold text-center text-uppercase text-white mt-4">{{ trans('titles.loginHeader') }}</h3> --}}

								<!-- Form -->
								{!! Form::open(['url' => Route('api.order'), 'method' => 'POST', 'class' => 'pb-3 px-2 order-form', 'id' => 'buyMarketForm', 'role' => 'form']) !!}
									{{ csrf_field() }}
									{!! Form::hidden('order_side', 'buy') !!}
									{!! Form::hidden('order_type', 'market') !!}
									{!! Form::hidden('currency_1', $currency_1) !!}
									{!! Form::hidden('currency_2', $currency_2) !!}
									<!-- email -->
									<div class="md-form input-group mb-4">
										{!! Form::text('price', '0', array('readonly', 'id' => 'buy_market_price', 'class' => 'form-control text-white-50 price-value')) !!}
										{!! Form::label('price', 'price' , array('class' => 'text-white')); !!}
										<div class="input-group-append">
											<span class="input-group-text md-addon">BTC</span>
										</div>
									</div>

									<div class="md-form input-group mb-4">
										{!! Form::text('amount', null, array('id' => 'buy_market_amount', 'class' => 'form-control text-white')) !!}
										{!! Form::label('amount', 'amount' , array('class' => 'text-white')); !!}
										<div class="input-group-append">
											<span class="input-group-text md-addon">GUNTHY</span>
										</div>
									</div>

									<div class="md-form input-group mb-4 d-flex">
										<div class="grey-text">fee(0.05%)</div>
										<div class="ml-auto grey-text fee-price">0</div>
										<div class="input-group-append">
											<span class="input-group-text md-addon pt-0 pb-0 ">BTC</span>
										</div>
									</div>
									<div class="md-form input-group mb-4 d-flex">
										<div class="grey-text">Total</div>
										<div class="ml-auto grey-text total-price">0</div>
										<div class="input-group-append">
											<span class="input-group-text md-addon pt-0 pb-0">BTC</span>
										</div>
									</div>
									{!! Form::button('Buy', array('class' => 'btn btn-elegant btn-lg btn-block','type' => 'submit','id' => 'submit')) !!}
								{!! Form::close() !!}

							</div>

						</div>
						<!-- Card -->
					</div>
					<div class="col">
						<!-- Card -->
						<div class="card card-form">

							<!--Card content-->
							<div class="card-body bg-dark-2 p-2">
								<h5 class="text-white"><span class="text-uppercase">Buy GUNTHY</span><span>(Limit)</span></h5>
								<div class="grey-text d-flex justify-content-end"><span>Deposit BTC</span></div>
								@if (Auth::user()) <div class="grey-text">You have: <span class="balance-btc">0</span> BTC</div> @endif
								<div class="grey-text">Lowest Ask: <span class="lowest-ask">0</span> BTC</div>
								<hr class="success-color-dark ml-n2 mr-n2" /> {{--
								<h3 class="font-weight-bold text-center text-uppercase text-white mt-4">{{ trans('titles.loginHeader') }}</h3> --}}

								<!-- Form -->
								{!! Form::open(['url' => Route('api.order'), 'method' => 'POST', 'class' => 'pb-3 px-2 order-form', 'id' => 'buyLimitForm', 'role' => 'form']) !!}
									{{ csrf_field() }}
									{!! Form::hidden('order_side', 'buy') !!}
									{!! Form::hidden('order_type', 'limit') !!}
									{!! Form::hidden('currency_1', $currency_1) !!}
									{!! Form::hidden('currency_2', $currency_2) !!}
									<!-- email -->
									<div class="md-form input-group mb-4">
										{!! Form::text('price', '0', array('id' => 'buy_limit_price', 'class' => 'form-control text-white-50 price-value')) !!}
										{!! Form::label('buy_limit_price', 'price' , array('class' => 'text-white')); !!}
										<div class="input-group-append">
											<span class="input-group-text md-addon">BTC</span>
										</div>
									</div>

									<div class="md-form input-group mb-4">
										{!! Form::text('amount', null, array('id' => 'buy_limit_amount', 'class' => 'form-control text-white')) !!}
										{!! Form::label('buy_limit_amount', 'amount' , array('class' => 'text-white')); !!}
										<div class="input-group-append">
											<span class="input-group-text md-addon">GUNTHY</span>
										</div>
									</div>

									<div class="md-form input-group mb-4 d-flex">
										<div class="grey-text">fee(0.05%)</div>
										<div class="ml-auto grey-text fee-price">0</div>
										<div class="input-group-append">
											<span class="input-group-text md-addon pt-0 pb-0 ">BTC</span>
										</div>
									</div>
									<div class="md-form input-group mb-4 d-flex">
										<div class="grey-text">Total</div>
										<div class="ml-auto grey-text total-price">0</div>
										<div class="input-group-append">
											<span class="input-group-text md-addon pt-0 pb-0">BTC</span>
										</div>
									</div>
									{!! Form::button('Buy', array('class' => 'btn btn-elegant btn-lg btn-block','type' => 'submit','id' => 'submit')) !!}
								{!! Form::close() !!}

							</div>

						</div>
						<!-- Card -->
					</div>
					<div class="col">
						<!-- Card -->
						<div class="card card-form">

							<!--Card content-->
							<div class="card-body bg-dark-2 p-2">
								<h5 class="text-white"><span class="text-uppercase">Sell GUNTHY</span><span>(Market)</span></h5>
								<div class="grey-text d-flex justify-content-end"><span>Deposit GUNTHY</span></div>
								@if (Auth::user()) <div class="grey-text">You have: <span class="balance-gunthy">0</span> GUNTHY</div> @endif
								<div class="grey-text">Highest Bid: <span class="highest-bid">0</span> BTC</div>
								<hr class="danger-color-dark ml-n2 mr-n2" />

								<!-- Form -->
								{!! Form::open(['url' => Route('api.order'), 'method' => 'POST', 'class' => 'pb-3 px-2 order-form', 'id' => 'sellMarketForm', 'role' => 'form']) !!}
									{{ csrf_field() }}
									{!! Form::hidden('order_side', 'sell') !!}
									{!! Form::hidden('order_type', 'market') !!}
									{!! Form::hidden('currency_1', $currency_1) !!}
									{!! Form::hidden('currency_2', $currency_2) !!}
									
									<div class="md-form input-group mb-4">
										{!! Form::text('price', '0', array('readonly', 'id' => 'sell_market_price', 'class' => 'form-control text-white-50 price-value')) !!}
										{!! Form::label('sell_market_price', 'price' , array('class' => 'text-white')); !!}
										<div class="input-group-append">
											<span class="input-group-text md-addon">BTC</span>
										</div>
									</div>
									<div class="md-form input-group mb-4">
										{!! Form::text('amount', null, array('id' => 'sell_market_amount', 'class' => 'form-control text-white')) !!}
										{!! Form::label('sell_market_amount', 'amount' , array('class' => 'text-white')); !!}
										<div class="input-group-append">
											<span class="input-group-text md-addon">GUNTHY</span>
										</div>
									</div>

									<div class="md-form input-group mb-4 d-flex">
										<div class="grey-text">fee(0.05%)</div>
										<div class="ml-auto grey-text fee-price">0</div>
										<div class="input-group-append">
											<span class="input-group-text md-addon pt-0 pb-0 ">BTC</span>
										</div>
									</div>
									<div class="md-form input-group mb-4 d-flex">
										<div class="grey-text">Total</div>
										<div class="ml-auto grey-text total-price">0</div>
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
						<!-- Card -->
						<div class="card card-form">

							<!--Card content-->
							<div class="card-body bg-dark-2 p-2">
								<h5 class="text-white"><span class="text-uppercase">Sell GUNTHY</span><span>(Limit)</span></h5>
								<div class="grey-text d-flex justify-content-end"><span>Deposit GUNTHY</span></div>
								@if (Auth::user()) <div class="grey-text">You have: <span class="balance-gunthy">0</span> GUNTHY</div> @endif
								<div class="grey-text">Highest Bid: <span class="highest-bid">0</span> BTC</div>
								<hr class="danger-color-dark ml-n2 mr-n2" />

								<!-- Form -->
								{!! Form::open(['url' => Route('api.order'), 'method' => 'POST', 'class' => 'pb-3 px-2 order-form', 'id' => 'sellLimitForm', 'role' => 'form']) !!}
									{{ csrf_field() }}
									{!! Form::hidden('order_side', 'sell') !!}
									{!! Form::hidden('order_type', 'limit') !!}
									{!! Form::hidden('currency_1', $currency_1) !!}
									{!! Form::hidden('currency_2', $currency_2) !!}

									<div class="md-form input-group mb-4">
										{!! Form::text('price', '0', array('id' => 'sell_limit_price', 'class' => 'form-control text-white-50 price-value')) !!}
										{!! Form::label('sell_limit_price', 'price' , array('class' => 'text-white')); !!}
										<div class="input-group-append">
											<span class="input-group-text md-addon">BTC</span>
										</div>
									</div>

									<div class="md-form input-group mb-4">
										{!! Form::text('amount', null, array('id' => 'sell_limit_amount', 'class' => 'form-control text-white')) !!}
										{!! Form::label('sell_limit_amount', 'amount' , array('class' => 'text-white')); !!}
										<div class="input-group-append">
											<span class="input-group-text md-addon">GUNTHY</span>
										</div>
									</div>

									<div class="md-form input-group mb-4 d-flex">
										<div class="grey-text">fee(0.05%)</div>
										<div class="ml-auto grey-text fee-price">0</div>
										<div class="input-group-append">
											<span class="input-group-text md-addon pt-0 pb-0 ">BTC</span>
										</div>
									</div>
									<div class="md-form input-group mb-4 d-flex">
										<div class="grey-text">Total</div>
										<div class="ml-auto grey-text total-price">0</div>
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
			</div>

			<div class="p-3 mt-2">
				<div class="row">
					<div class="col">
						<div class="bg-dark-2 blockquote bq-primary text-light">
							Buy Orders
						</div>
						<table id="buyOrdersHistory" class="table table-striped" width="100%"></table>
					</div>
					<div class="col">
						<div class="bg-dark-2 blockquote bq-primary text-light">
							Sell Orders
						</div>
						<table id="sellOrdersHistory" class="table table-striped" width="100%"></table>
					</div>
				</div>
			</div>

			@if (Auth::user())
			<div class="p-3 mt-2">
				<div class="row">
					<div class="col">
						<div class="bg-dark-2 blockquote bq-primary text-light">
							Buy Open Orders
						</div>
						<table id="buyOpenOrdersHistory" class="table table-striped" width="100%"></table>
					</div>
					<div class="col">
						<div class="bg-dark-2 blockquote bq-primary text-light">
							Sell Open Orders
						</div>
						<table id="sellOpenOrdersHistory" class="table table-striped" width="100%"></table>
					</div>
				</div>
			</div>
			@endif

			<div class="p-3 mt-2">
				<div class="row">
					<div class="col">
						<div class="bg-dark-2 blockquote bq-primary text-light">
							Trade History
						</div>
						<table id="tradeHistory" class="table table-striped" width="100%"></table>
					</div>
					
					@if (Auth::user())
					<div class="col">
						<div class="bg-dark-2 blockquote bq-primary text-light">
							My Trade History
						</div>
						<table id="myTradeHistory" class="table table-striped" width="100%"></table>
					</div>
					@endif
				</div>
			</div>
		</div>
		<div class="col col-3">
			<div class="row">
				<div class="col">
					<div id="marketsContainer" class="animation-top">
						<div class="bg-dark-2 blockquote bq-primary text-light d-flex align-items-end">
							<div>Markets</div>
							<div id="namesOfMarkets" class="ml-4">
								<span class="@if ($currency_2 == 'BTC') {{ "active" }} @endif">BTC</span> |
								<span class="@if ($currency_2 == 'ETH') {{ "active" }} @endif">ETH</span>
							</div>
						</div>
						<table id="listOfMarkets" class="table table-striped" width="100%"></table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('head')
<link href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('css/addons/datatables.css') }}" rel="stylesheet">
<link href="{{ asset('css/addons/datatables-select.css') }}" rel="stylesheet">
<link href="{{ asset('css/pages/exchange.css') }}" rel="stylesheet">
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('js/modules/chart.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/datatables.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/datatables-select.js') }}"></script>
<script>
	var fee = {{ $fee }};
	var current_currency_1 = "{{ $currency_1 }}";
	var current_currency_2 = "{{ $currency_2 }}";
	var ticker_url = '{{ url("/api/ticker") }}';
</script>
<script>

	var marketsContainer = $('#marketsContainer');
	var marketsTable;

	function initMarketsList() {

		marketsTable = $('#listOfMarkets').dataTable( {
			"stateSave": true,
			"paging":   false,
			"info":     false,
			"bProcessing" : true,
			"bDestroy" : true,
			"bAutoWidth" : true,
			"sScrollY" : "200",
			"sScrollX" : "100%",
			"bScrollCollapse" : true,
			"bSort" : true,
			"sPaginationType" : "full_numbers",
			"iDisplayLength" : 25,
			"bLengthChange" : false,
			order: [ 0, 'desc' ],
			columns: [
				{
					name: 'currency_1', title: 'Coins', searchable: true, className: 'text-center currency_coin', orderable: true, mData: function (rowData, type, row, meta) {
						return '<span class="currency">' + rowData.currency_1 + '</span>';
						return rowData.currency_1 || ''
					}, fnCreatedCell : function (element, celldata, rowdata, rowid) {
						$(element).click(function(){
							window.location.href = "{{ route('exchange.show') }}?pair=" + rowdata.currency_1 + '-' + $('#namesOfMarkets > span.active').text();
						})
					}
				},
				{
					name: 'last', title: 'Price', searchable: true, className: 'text-right', orderable: true, mData: function (rowData, type, row, meta) {
						return rowData.last || ''
					}
				},
				{
					name: 'change', title: 'Change', searchable: true, className: 'text-right', mData: function (rowData, type, row, meta) {
						if(rowData.change > 0) {
							return '<span class="text-success d-flex justify-content-end align-items-center"><span style="margin-top:-4px; margin-right: 4px;">↑</span> ' + rowData.change +' %</span>'
						} else if(rowData.change < 0) {
							return '<span class="text-danger d-flex justify-content-end align-items-center"><span style="margin-top:-4px; margin-right: 4px;">↓</span> ' + rowData.change +' %</span>'
						}
						return "0 %";
					}
				},
				{
					name: 'quantity', title: '24H Vol', searchable: true, className: 'text-right', mData: function (rowData, type, row, meta) {
						return rowData.quantity || 0;
					}
				}
			]
		} );
		
		$('#listOfMarkets_wrapper .dataTables_filter').find('label').each(function () {
			$(this).parent().append($(this).children());
		});
		$('#listOfMarkets_wrapper .dataTables_filter').find('input').each(function (index, item) {
			$(item).attr("placeholder", "Search");
			$(item).removeClass('form-control-sm');
		});
		$('#listOfMarkets_wrapper .dataTables_filter').addClass('md-form');
		$('#listOfMarkets_wrapper .dataTables_filter').find('label').remove();


		$('#namesOfMarkets > span').click(function() {
			$('#namesOfMarkets > span').removeClass('active');
			$(this).addClass('active');
			updateMarketsInfo(true);
		})
	}
	function updateMarketsInfo(another_url = false)
	{
		var url = ticker_url + "?currency_2=" + $('#namesOfMarkets > span.active').html();
		get_api(url, 'GET')
			.then(market => {
				if(market) {
					// var page_number = marketsTable.api().page.info().page   
					// if(another_url) page_number = 0;
					marketsTable.fnClearTable();
					if(market.length > 0) marketsTable.fnAddData(market);
					marketsTable.fnDraw(true);
					// marketsTable.fnPageChange(page_number,true);
				}
			})
	}
	updateMarketsInfo();

	

	function refreshTable(table, url, another_url = false)
	{
		var page_number = table.api().page.info().page;
		if(url) table.api().ajax.url( url ).load(false);
		else table.api().ajax.reload( null, false );
		if(another_url) table.fnPageChange(page_number,true);
	}

	function updateCurrentMarketInfo(is_repeat = true) {
		var url = ticker_url + "?currency_1=" + current_currency_1 + "&currency_2=" + current_currency_2;
		get_api(url, 'GET')
			.then(market => {

				if(market && market[0]) {
					var current_market_info = market[0];
					// $('#buy_market_price, #sell_market_price').val(current_market_info.last);
					var site_24hr = $('.site-24hr-info');
					var change_class = "";
					if(current_market_info.change*1 > 0) change_class="text-success";
					if(current_market_info.change*1 < 0) change_class="text-danger";
					site_24hr.find('.last').html(current_market_info.last);
					site_24hr.find('.high').html(current_market_info.high);
					site_24hr.find('.low').html(current_market_info.low);
					site_24hr.find('.change').html(`<span class="${change_class}">${current_market_info.change} %</span>`);
					site_24hr.find('.vol-btc').html(current_market_info.quantity);
					site_24hr.find('.vol-currency').html(current_market_info.volumn*1);

					// var forms = $('.card.card-form');
					// forms.find('.last-price').html(current_market_info.last);
				}

				if(!is_repeat) return;

				setTimeout(() => {
					updateCurrentMarketInfo();
				}, 3000)
			})
	}

	var ctx = document.getElementById("lineChart");
	ctx.height = 70;
	var myLineChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["20:00", "21:00", "22:00", "23:00", "00:00", "01:00", "02:00"],
			datasets: [{
				label: "My First dataset",
				data: [1, 10, 7, 3, 8, 9, 3],
				backgroundColor: [
				'rgba(105, 0, 132, .2)',
				],
				borderColor: [
				'rgba(200, 99, 132, .7)',
				],
				borderWidth: 2
			},
			{
				label: "My Second dataset",
				data: [2, 4,8, 4, 3, 1, 4, 5],
				backgroundColor: [
				'rgba(0, 137, 132, .2)',
				],
				borderColor: [
				'rgba(0, 10, 130, .7)',
				],
				borderWidth: 2
			}]
		},
		options: {
			responsive: true
		}
	});

	function initOrderForm() {
		$('.order-form').each((index, elem) => {
			$(elem['amount']).on("change paste keyup", function() {
				if($(this).val() == '') var amount = 0;
				else var amount = parseInt($(this).val());
				var sum_price;
				if(amount === 0) sum_price = 0;
				else if(!amount || amount === NaN || amount === Infinity) sum_price = amount;
				else sum_price = _.multiply(amount, elem['price'].value);
				var fee_price = formatPrice(_.divide(_.multiply(sum_price, fee), 100));
				var total_price = _.add(sum_price, fee_price);

				$(elem).find('.fee-price').html(float2String(fee_price));
				$(elem).find('.total-price').html(float2String(total_price));
			});
		})
		
		var forms = $('.card.card-form .lowest-ask, .card.card-form .highest-bid').click(function(){
			$(this).parent().parent().find('input[name=price]').val($(this).text());
		})
	}

	var common_query = "?pair=" + current_currency_1 + "-" + current_currency_2 + '&local_timezone_offset=' + local_timezone_offset;
	var buyOrdersHistory = $('#buyOrdersHistory').dataTable( {
		// "processing": true,
		"serverSide": true,
		lengthMenu: [5, 10, 15],
		"ajax":{
			url :"{{ Route('api.buyOrders') }}" + common_query, // json datasource
			type: "get",  // method  , by default get
			error: function(){},
			"dataSrc": function ( json ) {
				var max_price = json.data[0] ? json.data[0].price : 0;
				var forms = $('.card.card-form .highest-bid').html(max_price);
				return json.data;
			}
		},
		order: [0, 'desc'],
		columns: [
			{
				data: 'price', name: 'price', title: `Price (${current_currency_2})`, searchable: true, orderable: true, mData: function (rowData, type, row, meta) {
					return `<span class="text-success">${rowData.price}</span>` || ''
				}
			},
			{
				data: 'quantity', name: 'quantity', title: `Amount (${current_currency_1})`, searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
					return rowData.quantity || '0'
				}
			},
			{
				title: `Total (${current_currency_2})`, searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
					return rowData.total || 0
				}
			},
		] 
	} );


	var sellOrdersHistory = $('#sellOrdersHistory').dataTable( {
		// "processing": true,
		"serverSide": true,
		lengthMenu: [5, 10, 15],
		"ajax":{
			url :"{{ Route('api.sellOrders') }}" + common_query, // json datasource
			type: "get",  // method  , by default get
			error: function(error){
				console.log(error);
			},
			"dataSrc": function ( json ) {
				var min_price = json.data[0] ? json.data[0].price : 0;
				var forms = $('.card.card-form .lowest-ask').html(min_price);
				return json.data;
			}
		},
		order: [0, 'asc'],
		columns: [
			{
				data: 'price', name: 'price', title: `Price (${current_currency_2})`, searchable: true, orderable: true, mData: function (rowData, type, row, meta) {
					return `<span class="text-danger">${rowData.price}</span>` || ''
				}
			},
			{
				data: 'quantity', name: 'quantity', title: `Amount (${current_currency_1})`, searchable: true, orderable:false, mData: function (rowData, type, row, meta) {
					return rowData.quantity || '0'
				}
			},
			{
				title: `Total (${current_currency_2})`, searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
					return rowData.total || 0
				}
			},
		]
	} );

	var tradeHistory = $('#tradeHistory').dataTable( {
		// "processing": true,
		"serverSide": true,
		lengthMenu: [5, 10, 15],
		"ajax":{
			url :"{{ Route('api.trades') }}" + common_query, // json datasource
			type: "get",  // method  , by default get
			error: function(){}
		},
		columns: [
			{
				title: 'Trade Time', name: 'trade_time', searchable: true, mData: function (rowData, type, row, meta) {
					return rowData.trade_time || 0
				}
			},
			{
				name: 'maker', title: 'Type', searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
					return formatOrderSide(rowData.maker) || ''
				}
			},
			{
				name: 'price', title: `Price (${current_currency_2})`, searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
					return rowData.price || ''
				}
			},
			{
				name: 'quantity', title: `Amount (${current_currency_1})`, searchable: true, mData: function (rowData, type, row, meta) {
					return rowData.quantity || '0'
				}
			},
			{
				name: 'total', title: `Total (${current_currency_2})`, searchable: false, mData: function (rowData, type, row, meta) {
					return rowData.total || 0
				}
			},
		],
		order: [0, 'desc']
	} );

	@if (Auth::user())
	$('#buyOpenOrdersHistory').DataTable( {
		"processing": true,
		"serverSide": true,
		lengthMenu: [5, 10, 15],
		"ajax":{
			url :"{{ Route('api.openBuyOrders') }}" + common_query, // json datasource
			type: "get",  // method  , by default get
			error: function(){}
		},
		columns: [
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
				title: 'Value', searchable: true, mData: function (rowData, type, row, meta) {
					// return $rootScope.changedDate(rowData['measure_time'])
					var value = _.multiply(rowData.quantity, rowData.price)
					return float2String(value) || 0
				}
			},
		] 
	} );

	$('#sellOpenOrdersHistory').DataTable( {
		"processing": true,
		"serverSide": true,
		lengthMenu: [5, 10, 15],
		"ajax":{
			url :"{{ Route('api.openSellOrders') }}" + common_query, // json datasource
			type: "get",  // method  , by default get
			error: function(){}
		},
		columns: [
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
				title: 'Value', searchable: true, mData: function (rowData, type, row, meta) {
					// return $rootScope.changedDate(rowData['measure_time'])
					var value = _.multiply(rowData.quantity, rowData.price)
					return float2String(value) || 0
				}
			},
		] 
	} );
	
	$('#myTradeHistory').DataTable( {
		"processing": true,
		"serverSide": true,
		lengthMenu: [5, 10, 15],
		"ajax":{
			url :"{{ Route('api.myTrades') }}" + common_query, // json datasource
			type: "get",  // method  , by default get
			error: function(error){
				console.log(error);
			},
			"dataSrc": function ( json ) {
				// console.log(json.data);
				return json.data;
			}
		},
		columns: [
			{
				data: 'maker', name: 'maker', title: 'Type', searchable: true, orderable: false, mData: function (rowData, type, row, meta) {
					return formatOrderSide(rowData.maker) || ''
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
			// {
			// 	name: 'total', title: `Total (${current_currency_2})`, searchable: false, mData: function (rowData, type, row, meta) {
			// 		return rowData.total || 0
			// 	}
			// },
			{
				data: 'value', title: 'Value', searchable: true, mData: function (rowData, type, row, meta) {
					return float2String(_.multiply(rowData.price, rowData.quantity)) || 0
				}
			},
			// {
			// 	title: 'Fee', searchable: true, mData: function (rowData, type, row, meta) {
			// 		var fee = _.multiply(0.0005, rowData.quantity);
			// 		fee = _.multiply(fee,rowData.price);
			// 		return float2String(fee) || 0
			// 	}
			// },
			{
				title: 'Trade Time', name: 'trade_time', searchable: true, mData: function (rowData, type, row, meta) {
					return rowData.trade_time || 0
				}
			},
		]
	} );
	@endif

	initMarketsList();

	initOrderForm();

	updateCurrentMarketInfo();

	setInterval(function(){
		updateMarketsInfo();
	}, 6000);


	setTimeout(function(){
		setInterval(function(){
			refreshTable(buyOrdersHistory);
		}, 10000);
	}, 1000)

	setTimeout(function(){
		setInterval(function(){
			refreshTable(sellOrdersHistory);
		}, 10000);
	}, 2000)

	setTimeout(function(){
		setInterval(function(){
			refreshTable(tradeHistory);
		}, 10000);
	}, 3000)

	function formatPrice(price) {
		return Math.ceil(price * 100000000) / 100000000;
	}

</script>
<script type="text/javascript" src="charting_library/charting_library.min.js"></script>
<script type="text/javascript" src="js/gunthy.datafeed.js"></script>
<!-- TradingView Widget BEGIN -->
{{-- <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script> --}}
{{-- <script type="text/javascript">
new TradingView.widget(
{
"width": 980,
"height": 610,
"symbol": "NASDAQ:AAPL",
"interval": "1",
"timezone": "Etc/UTC",
"theme": "Light",
"style": "1",
"locale": "en",
"toolbar_bg": "#f1f3f6",
"enable_publishing": false,
"hide_legend": true,
"withdateranges": true,
datafeed: new GunthyDatafeed({ debug: false }),
"allow_symbol_change": true,
"save_image": false,
"hotlist": true,
"news": [
	"stocktwits",
	"headlines"
],
"studies": [
	"MAExp@tv-basicstudies"
],
"container_id": "tradingview_823c3"
}
);
</script> --}}
<!-- TradingView Widget END -->


<script type="text/javascript">
	TradingView.onready(function () {
		var initData = window.initData || {};
		
		var widget = window.tvWidget = new TradingView.widget({
			debug: false,
			fullscreen: false,
			autosize: true,
			toolbar_bg: '#272727',
			"theme": "Dark",
			"style": "2",
			symbol: 'GUNTHY_BTC',
			interval: '60',
			container_id: "tradingview_823c3",
			datafeed: new GunthyDatafeed({ debug: false }),
			library_path: "charting_library/",
			locale: "en",
			"hide_top_toolbar": true,
			// drawings_access: { type: 'black', tools: [{ name: "Regression Trend" }] },
			disabled_features: ["use_localstorage_for_settings", "volume_force_overlay"],
			enabled_features: ["study_templates"],
			charts_storage_url: 'https://exchange.gunthy.org/trading_save',
			charts_storage_api_version: "1.1",
			client_id: 'tradingview.com',
			user_id: 'public_user_id',
			timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,

			"allow_symbol_change": true,
			"save_image": false,
			"hotlist": true,
			// "news": [
			// 	"stocktwits",
			// 	"headlines"
			// ],
			// "studies": [
			// 	"EMA Cross@tv-basicstudies"
			// ],
			overrides: {
				// "mainSeriesProperties.style": 1,
				"symbolWatermarkProperties.color" : "#944",
				"volumePaneSize": "medium",
				"editorFontsList": ['Verdana', 'Courier New', 'Times New Roman', 'Arial'],
				"paneProperties.background": "#222",
			},
			loading_screen: { backgroundColor: "#272727" }
			// studies_overrides: {
			// 	// "volume.volume.color.0": "red",
			// 	// "volume.volume.color.1": "green",
			// 	"volume.volume.transparency": 70,
			// 	"volume.volume ma.color": "#FF00FF",
			// 	"volume.volume ma.transparency": 30,
			// 	"volume.volume ma.linewidth": 5,
			// 	"volume.show ma": true,
			// 	"bollinger bands.median.color": "#33FF88",
			// 	"bollinger bands.upper.linewidth": 7,
			// 	"bollinger bands.median.color": "#33FF88",
			// 	"bollinger bands.upper.linewidth": 7
			// },
		});
		widget.onChartReady(function() {
			// widget.chart().createStudy('EMA Cross', false, true);
		});
	});
</script>

@endsection
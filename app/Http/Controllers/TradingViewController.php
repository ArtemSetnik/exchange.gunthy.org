<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\LiquidityClient;
use Carbon\Carbon;

class TradingViewController extends Controller
{
    public function config(Request $request)
    {
        return response()->json([
            // "supported_resolutions" => ['1', '5', '15', '30', '60', '1D', '1W', '1M'],
            "supports_group_request" => false,
            "supports_marks" => true,
            "supports_search" => true,
            "supports_time" => true,
            "supports_timescale_marks" => true,
            "exchanges" => [
                ["value" => '', "name" => 'All Exchanges', "desc" => ''],
                ["value" => 'XETRA', "name" => 'XETRA', "desc" => 'XETRA'],
                ["value" => 'NSE', "name" => 'NSE', "desc" => 'NSE']
            ],
            "symbolsTypes" => [
                ["name" => "All types", "value" => ""],
                ["name" => "Stock", "value" => "stock"],
                ["name" => "Index", "value" => "index"]
            ],
            "supported_resolutions" => ["1", "15", "30", "60", "1D", "2D", "3D", "1W", "3W", "1M", '6M']
        ], 200);
        // return [
        //     "supports_search" => true,
        //     "supports_marks" => true,
        //     "exchanges" => [
        //         ["value" => "", "name" => "All Exchanges", "desc" => ""],
        //         ["value" => "KRAKEN", "name" => "KRAKEN", "desc" => "KRAKEN"]
        //     ],
        //     "symbolsTypes" => [
        //         ["name" => "All types", "value" => ""],
        //         ["name" => "Stock", "value" => "stock"],
        //         ["name" => "Index", "value" => "index"]
        //     ],
        //     "supportedResolutions" => [ "1", "15", "30", "60", "1D", "2D", "3D", "1W", "3W", "1M", '6M' ]
        // ];
    }

    public function symbol_info(Request $request)
    {
        $group = $request->get('group');
        return response()->json([
            // "symbols" => ["MSFT", "AAPL", "FB", "GOOG"],
            "min_price_move" => 0.0000001,
            // "description" => ["Microsoft corp.", "Apple Inc", "Facebook", "Google"],
            "symbol" => ["GUNTHY"],
            "description" => ["GUNTHY_BTC"],
            "resolution" => "1",
            // "exchange-listed" => "NYSE",
            // "exchange-traded" => "NYSE",
            "minmovement" => 1,
            "minmovement2" => 0,
            "pricescale" => [1, 1, 100000],
            "has-dwm" => true,
            "has-intraday" => true,
            "has-no-volume" => [true],
            "type" => ["stock"],
            "ticker" => ["GUNTHY_BTC"],
            "timezone" => "America/New_York",
            "session-regular" => "0900-1600",
        ], 200);
    }

    public function symbols(Request $request)
    {
        $symbol = $request->get('symbol');
        $data = [
            "description" => "Gunthy",
            "exchange-listed" => "NYSE",
            "exchange-traded" => "NYSE",
            "has_intraday" => false,
            "has_no_volume" => false,
            "minmov" => 1,
            "minmov2" => 0,
            "name" => "GUNTHY_BTC",
            "pointvalue" => 0.0001,
            "pricescale" => 0.0001,
            "session" => "0930-1630",
            "supported_resolutions" => ["1", "15", "30", "60", "1D", "2D", "3D", "1W", "3W", "1M", '6M'],
            "ticker" => "GUNTHY_BTC",
            "timezone" => "America/New_York",
            "type" => "stock",
        ];
        return response()->json($data, 200);
    }

    public function search(Request $request)
    { }

    public function history(Request $request)
    {
        $to = $request->get('to');
        $symbol = $request->get('symbol');
        $resolution = $request->get('resolution');
        $from = $request->get('from');

        $data['since'] = $from * 1000;
        $periods = ["1" => "1min", "5" => "5min", "15" => "15min", "30" => "30min", "60" => "1hour", "1D" => "1day", "D"  => "1day", "1W" => "1week"];
        $period = empty($periods[$resolution]) ? "1day" : $periods[$resolution];

        $response = LiquidityClient::get_api("OHLC/$symbol/$period", $data);
        if ($response['code'] == 10000) {
            $data = $response['Data'];
            $data['s'] = 'ok';
        } else {
            $data = [
                "s" => "no_data",
                "nextTime" => Carbon::now()->timestamp
            ];
        }

        return response()->json($data, 200);
    }

    public function marks(Request $request)
    {
        $data = [
            "color" => ["red", "blue", "green", "red", "blue", "green"],
            "id" => [0, 1, 2, 3, 4, 5],
            "label" => ["A", "B", "CORE", "D", "EURO", "F"],
            "labelFontColor" => ["white", "white", "red", "#FFFFFF", "white", "#000"],
            "minSize" => [14, 28, 7, 40, 7, 14],
            "text" => [
                "Today",
                "4 days back",
                "7 days back + Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "7 days back once again",
                "15 days back",
                "30 days back",
            ],
            "time" => [1552348800, 1552003200, 1551744000, 1551744000, 1551052800, 1549756800],
        ];
        return response()->json($data, 200);
    }

    public function timescale_marks(Request $request)
    {
        $data = [
            ["id" => "tsm1", "time" => 1552348800, "color" => "red", "label" => "A", " tooltip" => ""],
            ["id" => "tsm2", "time" => 1552003200, "color" => "blue", "label" => "D", "tooltip" => ["Dividends: $0.56", "Date: Fri Mar 08 2019"]],
            ["id" => "tsm3", "time" => 1551744000, "color" => "green", "label" => "D", "tooltip" => ["Dividends: $0.56", "Date: Fri Mar 08 2019"]],
            ["id" => "tsm4", "time" => 1551052800, "color" => "#999999", "label" => "E", "tooltip" => ["Dividends: $0.56", "Date: Fri Mar 08 2019"]],
            ["id" => "tsm7", "time" => 1549756800, "color" => "red", "label" => "E", "tooltip" => ["Dividends: $0.56", "Date: Fri Mar 08 2019"]],
        ];
        return response()->json($data, 200);
    }

    public function time(Request $request)
    {
        return response()->json(Carbon::now()->timestamp, 200);
    }

    public function quotes(Request $request)
    { }


    public function serverTime(Request $request)
    {
        $data['serverTime'] = $this->_serverTime();
        return response()->json($data, 200);
    }

    public function exchangeInfo(Request $request)
    {
        $data = [
            "exchangeFilters" => [],
            "rateLimits" => [
                [
                    "interval" => "MINUTE",
                    "intervalNum" => 1,
                    "limit" => 1200,
                    "rateLimitType" => "REQUEST_WEIGHT"
                ],
                [
                    "interval" => "SECOND",
                    "intervalNum" => 1,
                    "limit" => 10,
                    "rateLimitType" => "ORDERS"
                ],
                [
                    "interval" => "DAY",
                    "intervalNum" => 1,
                    "limit" => 100000,
                    "rateLimitType" => "ORDERS"
                ]
            ],
            "serverTime" => $this->_serverTime(),
            "timezone" => "UTC",
            "minmov" => 1,
            "pricescale" => 1000000,
            "minmove2" => 1,
            "fractional" => true,
            "symbols" => [
                [
                    "baseAsset" => "GUNTHY",
                    "baseAssetPrecision" => 1,
                    "filters" => [
                        ["filterType" => "PRICE_FILTER", "minPrice" => "0.00000000", "maxPrice" => "0.00000000", "tickSize" => "0.00000001"],
                        // ["filterType" => "PERCENT_PRICE", "multiplierUp" => "10", "multiplierDown" => "0.1", "avgPriceMins" => 5],
                        // ["filterType" => "LOT_SIZE", "minQty" => "0.00100000", "maxQty" => "10000000.00000000", "stepSize" => "0.00000001"],
                        // ["filterType" => "MIN_NOTIONAL", "minNotional" => "1.00000000", "applyToMarket" => true, "avgPriceMins" => 5],
                        // ["filterType" => "ICEBERG_PARTS", "limit" => 10],
                        // ["filterType" => "MAX_NUM_ALGO_ORDERS", "maxNumAlgoOrders" => 5]
                    ],
                    "icebergAllowed" => true,
                    "isMarginTradingAllowed" => false,
                    "isSpotTradingAllowed" => true,
                    "orderTypes" => ["LIMIT", "LIMIT_MAKER", "MARKET", "STOP_LOSS_LIMIT", "TAKE_PROFIT_LIMIT"],
                    "quoteAsset" => "BTC",
                    "quotePrecision" => 8,
                    "status" => "TRADING",
                    "symbol" => "GUNTHY_BTC",
                ]
            ]
        ];
        return response()->json($data, 200);
    }

    public function klines(Request $request)
    {
        $symbol = $request->get('symbol');
        $interval = $request->get('interval');
        $limit = $request->get('limit');
        $startTime = $request->get('startTime') * 1;
        $endTime = $request->get('endTime') * 1;

        $period = $this->getPeriod($interval);
        $since = $startTime;
        $size = $limit;
        $pair = $symbol;

        $response = LiquidityClient::get_api("kline/$pair/$period", compact('size, since'));
        $data = $this->filterHistory($response['kline'], $startTime, $endTime);

        return response()->json($data, 200);
    }

    protected function filterHistory($data, $from, $to)
    {
        $result = [];
        if (!is_array($data)) return $result;
        foreach ($data as $item) {
            if ($from <= $item[0] * 1 && $item[0] * 1 <= $to) $result[] = $item;
        }
        return $result;
    }

    protected function _serverTime()
    {
        return Carbon::now()->timestamp * 1000;
    }

    protected function supportedResolutions()
    {
        $data = [
            '1', '5', '15', '30', '60', '120', '240', '360', '720', '1D', '1W'
        ];
        return response()->json($data, 200);
    }

    protected function getPeriod($interval)
    {
        $interval .= '';
        switch ($interval) {
            case '1':
            case '1min':
                return '1min';

            case '5':
            case '5min':
                return '5min';

            case '15':
            case '15min':
                return '15min';

            case '30':
            case '30min':
                return '30min';

            case '60':
            case '1h':
                return '1hour';

            case '120':
            case '2h':
                return '2hour';

            case '240':
            case '4h':
                return '4hour';

            case '360':
            case '6h':
                return '6hour';

            case '720':
            case '12h':
                return '12hour';

            case '1440':
            case '1d':
                return '1day';

            case '10080':
            case '1W':
                return '1week';


            default:
                return '1day';
        }
    }
    public function charts(Request $request)
    {
        $chart_id = $request->get('chart');
        $data = [
            "layout" => "s",
            "charts" => [[
                "panes" => [[
                    "sources" => [[
                        "type" => "MainSeries",
                        "id" => "6C8HdN",
                        "state" => [
                            "style" => 4,
                            "esdShowDividends" => true,
                            "esdShowSplits" => true,
                            "esdShowEarnings" => true,
                            "esdShowBreaks" => false,
                            "esdBreaksStyle" => [
                                "color" => "rgba( 235, 77, 92, 1)",
                                "style" => 2,
                                "width" => 1
                            ],
                            "esdFlagSize" => 2,
                            "showCountdown" => true,
                            "showInDataWindow" => true,
                            "visible" => true,
                            "showPriceLine" => true,
                            "priceLineWidth" => 1,
                            "priceLineColor" => "",
                            "baseLineColor" => "#B2B5BE",
                            "showPrevClosePriceLine" => false,
                            "prevClosePriceLineWidth" => 1,
                            "prevClosePriceLineColor" => "rgba( 85, 85, 85, 1)",
                            "minTick" => "default",
                            "extendedHours" => false,
                            "dividendsAdjustment" => false,
                            "sessVis" => false,
                            "statusViewStyle" => [
                                "fontSize" => 16,
                                "showExchange" => true,
                                "showInterval" => true,
                                "showSymbolAsDe\scription" => false
                            ],
                            "candleStyle" => [
                                "upColor" => "#26a69a",
                                "downColor" => "#ef5350",
                                "drawWick" => true,
                                "drawBorder" => true,
                                "borderColor" => "#378658",
                                "borderUpColor" => "#26a69a",
                                "borderDownColor" => "#ef5350",
                                "wickColor" => "#737375",
                                "wickUpColor" => "#26a69a",
                                "wickDownColor" => "#ef5350",
                                "barColorsOnPrevClose" => false
                            ],
                            "hollowCandleStyle" => [
                                "upColor" => "#26a69a",
                                "downColor" => "#ef5350",
                                "drawWick" => true,
                                "drawBorder" => true,
                                "borderColor" => "rgba( 55, 134, 88, 1)",
                                "borderUpColor" => "#26a69a",
                                "borderDownColor" => "#ef5350",
                                "wickColor" => "rgba( 115, 115, 117, 1)",
                                "wickUpColor" => "#26a69a",
                                "wickDownColor" => "#ef5350"
                            ],
                            "haStyle" => [
                                "upColor" => "#26a69a",
                                "downColor" => "#ef5350",
                                "drawWick" => true,
                                "drawBorder" => true,
                                "borderColor" => "rgba( 55, 134, 88, 1)",
                                "borderUpColor" => "#26a69a",
                                "borderDownColor" => "#ef5350",
                                "wickColor" => "rgba( 115, 115, 117, 1)",
                                "wickUpColor" => "#26a69a",
                                "wickDownColor" => "#ef5350",
                                "showRealLastPrice" => false,
                                "barColorsOnPrevClose" => false,
                                "inputs" => [],
                                "inputInfo" => []
                            ],
                            "barStyle" => [
                                "upColor" => "#26a69a",
                                "downColor" => "#ef5350",
                                "barColorsOnPrevClose" => false,
                                "dontDrawOpen" => false,
                                "thinBars" => true
                            ],
                            "hiloStyle" => [
                                "color" => "#2196f3",
                                "showBorders" => true,
                                "borderColor" => "#2196f3",
                                "showLabels" => true,
                                "labelColor" => "#2196f3",
                                "fontSize" => 7
                            ],
                            "lineStyle" => [
                                "color" => "#2196f3",
                                "linestyle" => 0,
                                "linewidth" => 3,
                                "priceSource" => "close",
                                "styleType" => 2
                            ],
                            "areaStyle" => [
                                "color1" => "#2196f3",
                                "color2" => "#2196f3",
                                "linecolor" => "#2196f3",
                                "linestyle" => 0,
                                "linewidth" => 3,
                                "priceSource" => "close",
                                "transparency" => 95
                            ],
                            "renkoStyle" => [
                                "upColor" => "#26a69a",
                                "downColor" => "#ef5350",
                                "borderUpColor" => "#26a69a",
                                "borderDownColor" => "#ef5350",
                                "upColorProjection" => "rgba( 169, 220, 195, 1)",
                                "downColorProjection" => "rgba( 245, 166, 174, 1)",
                                "borderUpColorProjection" => "rgba( 169, 220, 195, 1)",
                                "borderDownColorProjection" => "rgba( 245, 166, 174, 1)",
                                "wickUpColor" => "#26a69a",
                                "wickDownColor" => "#ef5350",
                                "inputs" => [
                                    "source" => "close",
                                    "boxSize" => 3,
                                    "style" => "ATR",
                                    "atrLength" => 14,
                                    "wicks" => true
                                ],
                                "inputInfo" => [
                                    "source" => [
                                        "name" => "Source"
                                    ],
                                    "boxSize" => [
                                        "name" => "Box size"
                                    ],
                                    "style" => [
                                        "name" => "Style"
                                    ],
                                    "atrLength" => [
                                        "name" => "ATR Length"
                                    ],
                                    "wicks" => [
                                        "name" => "Wicks"
                                    ]
                                ]
                            ],
                            "pbStyle" => [
                                "upColor" => "#26a69a",
                                "downColor" => "#ef5350",
                                "borderUpColor" => "#26a69a",
                                "borderDownColor" => "#ef5350",
                                "upColorProjection" => "rgba( 169, 220, 195, 1)",
                                "downColorProjection" => "rgba( 245, 166, 174, 1)",
                                "borderUpColorProjection" => "rgba( 169, 220, 195, 1)",
                                "borderDownColorProjection" => "rgba( 245, 166, 174, 1)",
                                "inputs" => [
                                    "source" => "close",
                                    "lb" => 3
                                ],
                                "inputInfo" => [
                                    "source" => [
                                        "name" => "Source"
                                    ],
                                    "lb" => [
                                        "name" => "Number of line"
                                    ]
                                ]
                            ],
                            "kagiStyle" => [
                                "upColor" => "#26a69a",
                                "downColor" => "#ef5350",
                                "upColorProjection" => "rgba( 169, 220, 195, 1)",
                                "downColorProjection" => "rgba( 245, 166, 174, 1)",
                                "inputs" => [
                                    "source" => "close",
                                    "style" => "ATR",
                                    "atrLength" => 14,
                                    "reversalAmount" => 1
                                ],
                                "inputInfo" => [
                                    "source" => [
                                        "name" => "Source"
                                    ],
                                    "style" => [
                                        "name" => "Style"
                                    ],
                                    "atrLength" => [
                                        "name" => "ATR Length"
                                    ],
                                    "reversalAmount" => [
                                        "name" => "Reversal amount"
                                    ]
                                ]
                            ],
                            "pnfStyle" => [
                                "upColor" => "#26a69a",
                                "downColor" => "#ef5350",
                                "upColorProjection" => "rgba( 169, 220, 195, 1)",
                                "downColorProjection" => "rgba( 245, 166, 174, 1)",
                                "inputs" => [
                                    "sources" => "Close",
                                    "reversalAmount" => 3,
                                    "boxSize" => 1,
                                    "style" => "ATR",
                                    "atrLength" => 14
                                ],
                                "inputInfo" => [
                                    "sources" => [
                                        "name" => "Source"
                                    ],
                                    "boxSize" => [
                                        "name" => "Box size"
                                    ],
                                    "reversalAmount" => [
                                        "name" => "Reversal amount"
                                    ],
                                    "style" => [
                                        "name" => "Style"
                                    ],
                                    "atrLength" => [
                                        "name" => "ATR Length"
                                    ]
                                ]
                            ],
                            "baselineStyle" => [
                                "baselineColor" => "rgba( 117, 134, 150, 1)",
                                "topFillColor1" => "rgba( 38, 166, 154, 0.05)",
                                "topFillColor2" => "rgba( 38, 166, 154, 0.05)",
                                "bottomFillColor1" => "rgba( 239, 83, 80, 0.05)",
                                "bottomFillColor2" => "rgba( 239, 83, 80, 0.05)",
                                "topLineColor" => "rgba( 38, 166, 154, 1)",
                                "bottomLineColor" => "rgba( 239, 83, 80, 1)",
                                "topLineWidth" => 3,
                                "bottomLineWidth" => 3,
                                "priceSource" => "close",
                                "transparency" => 50,
                                "baseLevelPercentage" => 50
                            ],
                            "rangeStyle" => [
                                "upColor" => "#26a69a",
                                "downColor" => "#ef5350",
                                "thinBars" => true,
                                "upColorProjection" => "rgba( 169, 220, 195, 1)",
                                "downColorProjection" => "rgba( 245, 166, 174, 1)",
                                "inputs" => [
                                    "range" => 10,
                                    "phantomBars" => false
                                ],
                                "inputInfo" => [
                                    "range" => [
                                        "name" => "Range"
                                    ],
                                    "phantomBars" => [
                                        "name" => "Phantom Bars"
                                    ]
                                ]
                            ],
                            "symbol" => "BITFINEX =>BTCUSD",
                            "shortName" => "BTCUSD",
                            "timeframe" => "",
                            "onWidget" => false,
                            "interval" => "D",
                            "priceAxisProperties" => [
                                "autoScale" => true,
                                "autoScaleDisabled" => false,
                                "lockScale" => false,
                                "percentage" => false,
                                "percentageDisabled" => false,
                                "log" => false,
                                "logDisabled" => false,
                                "alignLabels" => true,
                                "isInverted" => false,
                                "indexedTo100" => false
                            ]
                        ],
                        "zorder" => -1,
                        "haStyle" => [
                            "studyId" => "BarSetHeikenAshi@tv-basicstudies-60"
                        ],
                        "renkoStyle" => [
                            "studyId" => "BarSetRenko@tv-prostudies-15"
                        ],
                        "pbStyle" => [
                            "studyId" => "BarSetPriceBreak@tv-prostudies-15"
                        ],
                        "kagiStyle" => [
                            "studyId" => "BarSetKagi@tv-prostudies-15"
                        ],
                        "pnfStyle" => [
                            "studyId" => "BarSetPnF@tv-prostudies-15"
                        ],
                        "rangeStyle" => [
                            "studyId" => "BarSetRange@tv-basicstudies-72"
                        ],
                        "boxSize" => 101.2
                    ], [
                        "type" => "Study",
                        "id" => "TfS2oy",
                        "state" => [
                            "palettes" => [
                                "volumePalette" => [
                                    "colors" => [
                                        "0" => [
                                            "color" => "#26a69a",
                                            "style" => 0,
                                            "width" => 1,
                                            "name" => "Growing"
                                        ],
                                        "1" => [
                                            "color" => "#ef5350",
                                            "style" => 0,
                                            "width" => 1,
                                            "name" => "Falling"
                                        ]
                                    ]
                                ]
                            ],
                            "precision" => "default",
                            "styles" => [
                                "vol" => [
                                    "linestyle" => 0,
                                    "linewidth" => 1,
                                    "plottype" => 5,
                                    "trackPrice" => false,
                                    "transparency" => 50,
                                    "visible" => true,
                                    "color" => "#0496ff",
                                    "histogramBase" => 0,
                                    "joinPoints" => false,
                                    "title" => "Volume"
                                ],
                                "vol_ma" => [
                                    "color" => "#ff9850",
                                    "linestyle" => 0,
                                    "linewidth" => 1,
                                    "plottype" => 0,
                                    "trackPrice" => false,
                                    "transparency" => 0,
                                    "visible" => false,
                                    "histogramBase" => 0,
                                    "joinPoints" => false,
                                    "title" => "Volume MA"
                                ]
                            ],
                            "inputs" => [
                                "col_prev_close" => false,
                                "length" => 20
                            ],
                            "bands" => [],
                            "area" => [],
                            "graphics" => [],
                            "showInDataWindow" => true,
                            "visible" => true,
                            "showStudyArguments" => true,
                            "plots" => [
                                "0" => [
                                    "id" => "vol",
                                    "type" => "line"
                                ],
                                "1" => [
                                    "id" => "vol_color",
                                    "palette" => "volumePalette",
                                    "target" => "vol",
                                    "type" => "colorer"
                                ],
                                "2" => [
                                    "id" => "vol_ma",
                                    "type" => "line"
                                ]
                            ],
                            "_metainfoVersion" => 44,
                            "de\scription" => "Volume",
                            "id" => "Volume@tv-basicstudies",
                            "is_price_study" => false,
                            "shortDe\scription" => "Vol",
                            "de\scription_localized" => "Volume",
                            "shortId" => "Volume",
                            "packageId" => "tv-basicstudies",
                            "version" => "83",
                            "fullId" => "Volume@tv-basicstudies-83",
                            "productId" => "tv-basicstudies",
                            "name" => "Volume@tv-basicstudies"
                        ],
                        "zorder" => -2,
                        "metaInfo" => [
                            "palettes" => [
                                "volumePalette" => [
                                    "colors" => [
                                        "0" => [
                                            "name" => "Growing"
                                        ],
                                        "1" => [
                                            "name" => "Falling"
                                        ]
                                    ]
                                ]
                            ],
                            "inputs" => [[
                                "defval" => 20,
                                "id" => "length",
                                "max" => 2000,
                                "min" => 1,
                                "name" => "MA Length",
                                "type" => "integer"
                            ], [
                                "defval" => false,
                                "id" => "col_prev_close",
                                "name" => "Color based on previous close",
                                "type" => "bool"
                            ]],
                            "plots" => [[
                                "id" => "vol",
                                "type" => "line"
                            ], [
                                "id" => "vol_color",
                                "palette" => "volumePalette",
                                "target" => "vol",
                                "type" => "colorer"
                            ], [
                                "id" => "vol_ma",
                                "type" => "line"
                            ]],
                            "graphics" => [],
                            "defaults" => [
                                "inputs" => [
                                    "col_prev_close" => false,
                                    "length" => 20
                                ],
                                "palettes" => [
                                    "volumePalette" => [
                                        "colors" => [
                                            "0" => [
                                                "color" => "#26a69a",
                                                "style" => 0,
                                                "width" => 1
                                            ],
                                            "1" => [
                                                "color" => "#ef5350",
                                                "style" => 0,
                                                "width" => 1
                                            ]
                                        ]
                                    ]
                                ],
                                "precision" => "0",
                                "styles" => [
                                    "vol" => [
                                        "linestyle" => 0,
                                        "linewidth" => 1,
                                        "plottype" => 5,
                                        "trackPrice" => false,
                                        "transparency" => 50,
                                        "visible" => true
                                    ],
                                    "vol_ma" => [
                                        "color" => "#ff9850",
                                        "linestyle" => 0,
                                        "linewidth" => 1,
                                        "plottype" => 0,
                                        "trackPrice" => false,
                                        "transparency" => 0,
                                        "visible" => false
                                    ]
                                ]
                            ],
                            "_metainfoVersion" => 44,
                            "de\scription" => "Volume",
                            "id" => "Volume@tv-basicstudies-83",
                            "is_price_study" => false,
                            "shortDe\scription" => "Vol",
                            "styles" => [
                                "vol" => [
                                    "histogramBase" => 0,
                                    "title" => "Volume"
                                ],
                                "vol_ma" => [
                                    "histogramBase" => 0,
                                    "title" => "Volume MA"
                                ]
                            ],
                            "de\scription_localized" => "Volume",
                            "shortId" => "Volume",
                            "packageId" => "tv-basicstudies",
                            "version" => "83",
                            "fullId" => "Volume@tv-basicstudies-83",
                            "productId" => "tv-basicstudies",
                            "name" => "Volume@tv-basicstudies"
                        ]
                    ]],
                    "leftAxisesState" => [],
                    "rightAxisesState" => [[
                        "state" => [
                            "id" => "A5CgRDGiKTuU",
                            "m_priceRange" => [
                                "m_maxValue" => 17102.800000000003,
                                "m_minValue" => 6982.8
                            ],
                            "m_isAutoScale" => true,
                            "m_isPercentage" => false,
                            "m_isIndexedTo100" => false,
                            "m_isLog" => false,
                            "m_isLockScale" => false,
                            "m_isInverted" => false,
                            "m_height" => 470,
                            "m_topMargin" => 0.1,
                            "m_bottomMargin" => 0.08
                        ],
                        "sources" => ["6C8HdN"]
                    ]],
                    "overlayPriceScales" => [
                        "TfS2oy" => [
                            "id" => "Fy3g6rtkyIm3",
                            "m_priceRange" => [
                                "m_maxValue" => 217447.91247688,
                                "m_minValue" => 0
                            ],
                            "m_isAutoScale" => true,
                            "m_isPercentage" => false,
                            "m_isIndexedTo100" => false,
                            "m_isLog" => false,
                            "m_isLockScale" => false,
                            "m_isInverted" => false,
                            "m_height" => 470,
                            "m_topMargin" => 0.75,
                            "m_bottomMargin" => 0
                        ]
                    ],
                    "stretchFactor" => 2000,
                    "mainSourceId" => "6C8HdN",
                    "priceScaleRatio" => null
                ]],
                "timeScale" => [
                    "m_barSpacing" => 4.374000000000002,
                    "m_rightOffset" => 10
                ],
                "chartProperties" => [
                    "paneProperties" => [
                        "background" => "#ffffff",
                        "gridProperties" => [
                            "color" => "#e1ecf2",
                            "style" => 0
                        ],
                        "vertGridProperties" => [
                            "color" => "#e1ecf2",
                            "style" => 0
                        ],
                        "horzGridProperties" => [
                            "color" => "#e1ecf2",
                            "style" => 0
                        ],
                        "crossHairProperties" => [
                            "color" => "#758696",
                            "style" => 2,
                            "transparency" => 0,
                            "width" => 1
                        ],
                        "topMargin" => 10,
                        "bottomMargin" => 8,
                        "axisProperties" => [
                            "autoScale" => true,
                            "autoScaleDisabled" => false,
                            "lockScale" => false,
                            "percentage" => false,
                            "percentageDisabled" => false,
                            "indexedTo100" => false,
                            "log" => false,
                            "logDisabled" => false,
                            "alignLabels" => true,
                            "isInverted" => false
                        ],
                        "legendProperties" => [
                            "showStudyArguments" => true,
                            "showStudyTitles" => true,
                            "showStudyValues" => true,
                            "showSeriesTitle" => true,
                            "showSeriesOHLC" => true,
                            "showLegend" => true,
                            "showBarChange" => true,
                            "showOnlyPriceSource" => true
                        ]
                    ],
                    "scalesProperties" => [
                        "backgroundColor" => "#ffffff",
                        "lineColor" => "#50535E",
                        "textColor" => "#50535E",
                        "fontSize" => 11,
                        "scaleSeriesOnly" => false,
                        "showSeriesLastValue" => true,
                        "seriesLastValueMode" => 1,
                        "showSeriesPrevCloseValue" => false,
                        "showStudyLastValue" => false,
                        "showSymbolLabels" => false,
                        "showStudyPlotLabels" => false,
                        "barSpacing" => 6
                    ],
                    "publishedChartsTimelineProperties" => [
                        "type" => "BarsMarksContainer",
                        "id" => "xgO6VX",
                        "pinnedTooltips" => []
                    ],
                    "chartEventsSourceProperties" => [
                        "visible" => true,
                        "futureOnly" => true,
                        "breaks" => [
                            "color" => "rgba(85, 85, 85, 1)",
                            "visible" => false,
                            "style" => 2,
                            "width" => 1
                        ]
                    ],
                    "priceScaleSelectionStrategyName" => "auto"
                ],
                "version" => 2,
                "timezone" => "Etc/UTC",
                "sessions" => [
                    "properties" => [
                        "graphics" => [
                            "backgrounds" => [
                                "inSession" => [
                                    "color" => "#6fa8dc",
                                    "transparency" => 60,
                                    "visible" => false
                                ],
                                "outOfSession" => [
                                    "color" => "#ffe599",
                                    "transparency" => 60,
                                    "visible" => false
                                ]
                            ],
                            "vertlines" => [
                                "sessBreaks" => [
                                    "color" => "#4985e7",
                                    "style" => 2,
                                    "visible" => false,
                                    "width" => 1
                                ]
                            ]
                        ]
                    ]
                ]
            ]]
        ];
        if (empty($chart_id)) {
            return [
                'status' => 'ok',
                'data' => [
                    [
                        "timestamp" => 1552784303,
                        "symbol" => "GUNTHY_BTC",
                        "resolution" => "D",
                        "id" => 123542,
                        "name" => "ODC"
                    ]
                ]
            ];
        } else {
            return [
                'status' => 'ok',
                'data' => [
                    'content' => '{"publish_request_id":"3rki7xhdx8r","name":"123456","description":"","resolution":"60","symbol_type":"","exchange":"","listed_exchange":"","symbol":"GUNTHY_BTC","short_name":"GUNTHY_BTC","legs":"[{\"symbol\":\"GUNTHY_BTC\",\"pro_symbol\":\"GUNTHY_BTC\"}]","content":"{\"layout\":\"s\",\"charts\":[{\"panes\":[{\"sources\":[{\"type\":\"MainSeries\",\"id\":\"xMDM4l\",\"state\":{\"style\":1,\"esdShowDividends\":true,\"esdShowSplits\":true,\"esdShowEarnings\":true,\"esdShowBreaks\":false,\"esdBreaksStyle\":{\"color\":\"rgba( 235, 77, 92, 1)\",\"style\":2,\"width\":1},\"esdFlagSize\":2,\"showCountdown\":false,\"showInDataWindow\":true,\"visible\":true,\"silentIntervalChange\":false,\"showPriceLine\":true,\"priceLineWidth\":1,\"priceLineColor\":\"\",\"showPrevClosePriceLine\":false,\"prevClosePriceLineWidth\":1,\"prevClosePriceLineColor\":\"rgba( 85, 85, 85, 1)\",\"minTick\":\"default\",\"extendedHours\":false,\"sessVis\":false,\"statusViewStyle\":{\"fontSize\":17,\"showExchange\":true,\"showInterval\":true,\"showSymbolAsDescription\":false},\"candleStyle\":{\"upColor\":\"#53b987\",\"downColor\":\"#eb4d5c\",\"drawWick\":true,\"drawBorder\":true,\"borderColor\":\"#378658\",\"borderUpColor\":\"#53b987\",\"borderDownColor\":\"#eb4d5c\",\"wickColor\":\"#B5B5B8\",\"wickUpColor\":\"#336854\",\"wickDownColor\":\"#7f323f\",\"barColorsOnPrevClose\":false},\"hollowCandleStyle\":{\"upColor\":\"#53b987\",\"downColor\":\"#eb4d5c\",\"drawWick\":true,\"drawBorder\":true,\"borderColor\":\"#378658\",\"borderUpColor\":\"#53b987\",\"borderDownColor\":\"#eb4d5c\",\"wickColor\":\"#B5B5B8\",\"wickUpColor\":\"#336854\",\"wickDownColor\":\"#7f323f\"},\"haStyle\":{\"upColor\":\"#53b987\",\"downColor\":\"#eb4d5c\",\"drawWick\":true,\"drawBorder\":true,\"borderColor\":\"#378658\",\"borderUpColor\":\"#53b987\",\"borderDownColor\":\"#eb4d5c\",\"wickColor\":\"#B5B5B8\",\"wickUpColor\":\"#53b987\",\"wickDownColor\":\"#eb4d5c\",\"showRealLastPrice\":false,\"barColorsOnPrevClose\":false,\"inputs\":{},\"inputInfo\":{}},\"barStyle\":{\"upColor\":\"#53b987\",\"downColor\":\"#eb4d5c\",\"barColorsOnPrevClose\":false,\"dontDrawOpen\":false},\"lineStyle\":{\"color\":\"#6FB8F7\",\"linestyle\":0,\"linewidth\":1,\"priceSource\":\"close\",\"styleType\":2},\"areaStyle\":{\"color1\":\"#606090\",\"color2\":\"#01F6F5\",\"linecolor\":\"#0094FF\",\"linestyle\":0,\"linewidth\":1,\"priceSource\":\"close\",\"transparency\":50},\"priceAxisProperties\":{\"autoScale\":true,\"autoScaleDisabled\":false,\"lockScale\":false,\"percentage\":false,\"percentageDisabled\":false,\"log\":false,\"logDisabled\":false,\"alignLabels\":true},\"renkoStyle\":{\"upColor\":\"#53b987\",\"downColor\":\"#eb4d5c\",\"borderUpColor\":\"#53b987\",\"borderDownColor\":\"#eb4d5c\",\"upColorProjection\":\"#336854\",\"downColorProjection\":\"#7f323f\",\"borderUpColorProjection\":\"#336854\",\"borderDownColorProjection\":\"#7f323f\",\"wickUpColor\":\"#336854\",\"wickDownColor\":\"#7f323f\",\"inputs\":{\"source\":\"close\",\"boxSize\":3,\"style\":\"ATR\",\"atrLength\":14,\"wicks\":true},\"inputInfo\":{\"source\":{\"name\":\"Source\"},\"boxSize\":{\"name\":\"Box size\"},\"style\":{\"name\":\"Style\"},\"atrLength\":{\"name\":\"ATR Length\"},\"wicks\":{\"name\":\"Wicks\"}}},\"pbStyle\":{\"upColor\":\"#53b987\",\"downColor\":\"#eb4d5c\",\"borderUpColor\":\"#53b987\",\"borderDownColor\":\"#eb4d5c\",\"upColorProjection\":\"#336854\",\"downColorProjection\":\"#7f323f\",\"borderUpColorProjection\":\"#336854\",\"borderDownColorProjection\":\"#7f323f\",\"inputs\":{\"source\":\"close\",\"lb\":3},\"inputInfo\":{\"source\":{\"name\":\"Source\"},\"lb\":{\"name\":\"Number of line\"}}},\"kagiStyle\":{\"upColor\":\"#53b987\",\"downColor\":\"#eb4d5c\",\"upColorProjection\":\"#336854\",\"downColorProjection\":\"#7f323f\",\"inputs\":{\"source\":\"close\",\"style\":\"ATR\",\"atrLength\":14,\"reversalAmount\":1},\"inputInfo\":{\"source\":{\"name\":\"Source\"},\"style\":{\"name\":\"Style\"},\"atrLength\":{\"name\":\"ATR Length\"},\"reversalAmount\":{\"name\":\"Reversal amount\"}}},\"pnfStyle\":{\"upColor\":\"#53b987\",\"downColor\":\"#eb4d5c\",\"upColorProjection\":\"#336854\",\"downColorProjection\":\"#7f323f\",\"inputs\":{\"sources\":\"Close\",\"reversalAmount\":3,\"boxSize\":1,\"style\":\"ATR\",\"atrLength\":14},\"inputInfo\":{\"sources\":{\"name\":\"Source\"},\"boxSize\":{\"name\":\"Box size\"},\"reversalAmount\":{\"name\":\"Reversal amount\"},\"style\":{\"name\":\"Style\"},\"atrLength\":{\"name\":\"ATR Length\"}}},\"baselineStyle\":{\"baselineColor\":\"rgba( 117, 134, 150, 1)\",\"topFillColor1\":\"rgba( 83, 185, 135, 0.1)\",\"topFillColor2\":\"rgba( 83, 185, 135, 0.1)\",\"bottomFillColor1\":\"rgba( 235, 77, 92, 0.1)\",\"bottomFillColor2\":\"rgba( 235, 77, 92, 0.1)\",\"topLineColor\":\"rgba( 83, 185, 135, 1)\",\"bottomLineColor\":\"rgba( 235, 77, 92, 1)\",\"topLineWidth\":1,\"bottomLineWidth\":1,\"priceSource\":\"close\",\"transparency\":50,\"baseLevelPercentage\":50},\"symbol\":\"GUNTHY_BTC\",\"shortName\":\"GUNTHY_BTC\",\"timeframe\":\"\",\"onWidget\":false,\"interval\":\"60\"},\"zorder\":-1,\"haStyle\":{\"studyId\":\"BarSetHeikenAshi@tv-basicstudies-60\"},\"renkoStyle\":{\"studyId\":\"BarSetRenko@tv-prostudies-15\"},\"pbStyle\":{\"studyId\":\"BarSetPriceBreak@tv-prostudies-15\"},\"kagiStyle\":{\"studyId\":\"BarSetKagi@tv-prostudies-15\"},\"pnfStyle\":{\"studyId\":\"BarSetPnF@tv-prostudies-15\"}},{\"type\":\"study_Volume\",\"id\":\"Mg4QCy\",\"state\":{\"styles\":{\"vol\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":5,\"trackPrice\":false,\"transparency\":65,\"visible\":true,\"color\":\"#000080\",\"histogramBase\":0,\"joinPoints\":false,\"title\":\"Volume\"},\"vol_ma\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":4,\"trackPrice\":false,\"transparency\":65,\"visible\":true,\"color\":\"#0496FF\",\"histogramBase\":0,\"joinPoints\":false,\"title\":\"Volume MA\"}},\"precision\":\"default\",\"palettes\":{\"volumePalette\":{\"colors\":{\"0\":{\"color\":\"#eb4d5c\",\"width\":1,\"style\":0,\"name\":\"Color 0\"},\"1\":{\"color\":\"#53b987\",\"width\":1,\"style\":0,\"name\":\"Color 1\"}}}},\"inputs\":{\"showMA\":false,\"maLength\":20},\"bands\":{},\"area\":{},\"graphics\":{},\"showInDataWindow\":true,\"visible\":true,\"showStudyArguments\":true,\"paneSize\":\"medium\",\"plots\":{\"0\":{\"id\":\"vol\",\"type\":\"line\"},\"1\":{\"id\":\"volumePalette\",\"palette\":\"volumePalette\",\"target\":\"vol\",\"type\":\"colorer\"},\"2\":{\"id\":\"vol_ma\",\"type\":\"line\"}},\"_metainfoVersion\":15,\"isTVScript\":false,\"isTVScriptStub\":false,\"is_hidden_study\":false,\"transparency\":65,\"description\":\"Volume\",\"shortDescription\":\"Volume\",\"is_price_study\":false,\"id\":\"Volume@tv-basicstudies\",\"description_localized\":\"Volume\",\"shortId\":\"Volume\",\"packageId\":\"tv-basicstudies\",\"version\":\"1\",\"fullId\":\"Volume@tv-basicstudies-1\",\"productId\":\"tv-basicstudies\",\"name\":\"Volume@tv-basicstudies\"},\"zorder\":-2,\"metaInfo\":{\"palettes\":{\"volumePalette\":{\"colors\":{\"0\":{\"name\":\"Color 0\"},\"1\":{\"name\":\"Color 1\"}}}},\"inputs\":[{\"id\":\"showMA\",\"name\":\"show MA\",\"defval\":false,\"type\":\"bool\"},{\"id\":\"maLength\",\"name\":\"MA Length\",\"defval\":20,\"type\":\"integer\",\"min\":1,\"max\":2000}],\"plots\":[{\"id\":\"vol\",\"type\":\"line\"},{\"id\":\"volumePalette\",\"palette\":\"volumePalette\",\"target\":\"vol\",\"type\":\"colorer\"},{\"id\":\"vol_ma\",\"type\":\"line\"}],\"graphics\":{},\"defaults\":{\"styles\":{\"vol\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":5,\"trackPrice\":false,\"transparency\":65,\"visible\":true,\"color\":\"#000080\"},\"vol_ma\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":4,\"trackPrice\":false,\"transparency\":65,\"visible\":true,\"color\":\"#0496FF\"}},\"precision\":0,\"palettes\":{\"volumePalette\":{\"colors\":{\"0\":{\"color\":\"#eb4d5c\",\"width\":1,\"style\":0},\"1\":{\"color\":\"#53b987\",\"width\":1,\"style\":0}}}},\"inputs\":{\"showMA\":false,\"maLength\":20}},\"_metainfoVersion\":15,\"isTVScript\":false,\"isTVScriptStub\":false,\"is_hidden_study\":false,\"transparency\":65,\"styles\":{\"vol\":{\"title\":\"Volume\",\"histogramBase\":0},\"vol_ma\":{\"title\":\"Volume MA\",\"histogramBase\":0}},\"description\":\"Volume\",\"shortDescription\":\"Volume\",\"is_price_study\":false,\"id\":\"Volume@tv-basicstudies-1\",\"description_localized\":\"Volume\",\"shortId\":\"Volume\",\"packageId\":\"tv-basicstudies\",\"version\":\"1\",\"fullId\":\"Volume@tv-basicstudies-1\",\"productId\":\"tv-basicstudies\",\"name\":\"Volume@tv-basicstudies\"}},{\"type\":\"Study\",\"id\":\"HcoBNp\",\"state\":{\"styles\":{\"plot_0\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":0,\"trackPrice\":false,\"transparency\":35,\"visible\":true,\"color\":\"#FF0000\",\"histogramBase\":0,\"joinPoints\":false,\"title\":\"Short\"},\"plot_1\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":0,\"trackPrice\":false,\"transparency\":35,\"visible\":true,\"color\":\"#008000\",\"histogramBase\":0,\"joinPoints\":false,\"title\":\"Long\"},\"plot_2\":{\"linestyle\":0,\"linewidth\":4,\"plottype\":3,\"trackPrice\":false,\"transparency\":35,\"visible\":true,\"color\":\"#000080\",\"histogramBase\":0,\"joinPoints\":false,\"title\":\"Crosses\"}},\"precision\":\"default\",\"inputs\":{\"in_0\":9,\"in_1\":26},\"palettes\":{},\"bands\":{},\"area\":{},\"graphics\":{},\"showInDataWindow\":true,\"visible\":true,\"showStudyArguments\":true,\"plots\":{\"0\":{\"id\":\"plot_0\",\"type\":\"line\"},\"1\":{\"id\":\"plot_1\",\"type\":\"line\"},\"2\":{\"id\":\"plot_2\",\"type\":\"line\"}},\"_metainfoVersion\":27,\"isTVScript\":false,\"isTVScriptStub\":false,\"is_hidden_study\":false,\"description\":\"EMA Cross\",\"shortDescription\":\"EMA Cross\",\"is_price_study\":true,\"id\":\"EMA Cross@tv-basicstudies\",\"scriptIdPart\":\"\",\"name\":\"EMA Cross@tv-basicstudies\",\"description_localized\":\"EMA Cross\",\"shortId\":\"EMA Cross\",\"packageId\":\"tv-basicstudies\",\"version\":\"1\",\"fullId\":\"EMA Cross@tv-basicstudies-1\",\"productId\":\"tv-basicstudies\",\"parseValue\":{},\"defaultInputs\":{},\"symbolInputId\":{}},\"zorder\":-3,\"metaInfo\":{\"palettes\":{},\"inputs\":[{\"id\":\"in_0\",\"name\":\"Short\",\"defval\":9,\"type\":\"integer\",\"min\":1,\"max\":2000},{\"id\":\"in_1\",\"name\":\"Long\",\"defval\":26,\"type\":\"integer\",\"min\":1,\"max\":2000}],\"plots\":[{\"id\":\"plot_0\",\"type\":\"line\"},{\"id\":\"plot_1\",\"type\":\"line\"},{\"id\":\"plot_2\",\"type\":\"line\"}],\"graphics\":{},\"defaults\":{\"styles\":{\"plot_0\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":0,\"trackPrice\":false,\"transparency\":35,\"visible\":true,\"color\":\"#FF0000\"},\"plot_1\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":0,\"trackPrice\":false,\"transparency\":35,\"visible\":true,\"color\":\"#008000\"},\"plot_2\":{\"linestyle\":0,\"linewidth\":4,\"plottype\":3,\"trackPrice\":false,\"transparency\":35,\"visible\":true,\"color\":\"#000080\"}},\"precision\":4,\"inputs\":{\"in_0\":9,\"in_1\":26}},\"_metainfoVersion\":27,\"isTVScript\":false,\"isTVScriptStub\":false,\"is_hidden_study\":false,\"styles\":{\"plot_0\":{\"title\":\"Short\",\"histogramBase\":0,\"joinPoints\":false},\"plot_1\":{\"title\":\"Long\",\"histogramBase\":0,\"joinPoints\":false},\"plot_2\":{\"title\":\"Crosses\",\"histogramBase\":0,\"joinPoints\":false}},\"description\":\"EMA Cross\",\"shortDescription\":\"EMA Cross\",\"is_price_study\":true,\"id\":\"EMA Cross@tv-basicstudies-1\",\"scriptIdPart\":\"\",\"name\":\"EMA Cross@tv-basicstudies\",\"description_localized\":\"EMA Cross\",\"shortId\":\"EMA Cross\",\"packageId\":\"tv-basicstudies\",\"version\":\"1\",\"fullId\":\"EMA Cross@tv-basicstudies-1\",\"productId\":\"tv-basicstudies\"}}],\"leftAxisState\":{\"m_priceRange\":null,\"m_isAutoScale\":true,\"m_isPercentage\":false,\"m_isLog\":false,\"m_isLockScale\":false,\"m_height\":270,\"m_topMargin\":0.05,\"m_bottomMargin\":0.05},\"leftAxisSources\":[],\"rightAxisState\":{\"m_priceRange\":{\"m_maxValue\":0.00008003,\"m_minValue\":5e-7},\"m_isAutoScale\":true,\"m_isPercentage\":false,\"m_isLog\":false,\"m_isLockScale\":false,\"m_height\":270,\"m_topMargin\":0.05,\"m_bottomMargin\":0.05},\"rightAxisSources\":[\"xMDM4l\",\"HcoBNp\"],\"overlayPriceScales\":{\"Mg4QCy\":{\"m_priceRange\":{\"m_maxValue\":2046009,\"m_minValue\":0},\"m_isAutoScale\":true,\"m_isPercentage\":false,\"m_isLog\":false,\"m_isLockScale\":false,\"m_height\":270,\"m_topMargin\":0.75,\"m_bottomMargin\":0}},\"stretchFactor\":2000,\"mainSourceId\":\"xMDM4l\"},{\"sources\":[{\"type\":\"Study\",\"id\":\"zt9Tas\",\"state\":{\"styles\":{\"plot_0\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":0,\"trackPrice\":false,\"transparency\":35,\"visible\":true,\"color\":\"#FF0000\",\"histogramBase\":0,\"joinPoints\":false,\"title\":\"Plot\"}},\"precision\":\"default\",\"inputs\":{},\"palettes\":{},\"bands\":{},\"area\":{},\"graphics\":{},\"showInDataWindow\":true,\"visible\":true,\"showStudyArguments\":true,\"plots\":{\"0\":{\"id\":\"plot_0\",\"type\":\"line\"}},\"_metainfoVersion\":27,\"isTVScript\":false,\"isTVScriptStub\":false,\"is_hidden_study\":false,\"description\":\"Balance of Power\",\"shortDescription\":\"Balance of Power\",\"is_price_study\":false,\"id\":\"Balance of Power@tv-basicstudies\",\"scriptIdPart\":\"\",\"name\":\"Balance of Power@tv-basicstudies\",\"description_localized\":\"Balance of Power\",\"shortId\":\"Balance of Power\",\"packageId\":\"tv-basicstudies\",\"version\":\"1\",\"fullId\":\"Balance of Power@tv-basicstudies-1\",\"productId\":\"tv-basicstudies\"},\"zorder\":-1,\"metaInfo\":{\"palettes\":{},\"inputs\":[],\"plots\":[{\"id\":\"plot_0\",\"type\":\"line\"}],\"graphics\":{},\"defaults\":{\"styles\":{\"plot_0\":{\"linestyle\":0,\"linewidth\":1,\"plottype\":0,\"trackPrice\":false,\"transparency\":35,\"visible\":true,\"color\":\"#FF0000\"}},\"precision\":4,\"inputs\":{}},\"_metainfoVersion\":27,\"isTVScript\":false,\"isTVScriptStub\":false,\"is_hidden_study\":false,\"styles\":{\"plot_0\":{\"title\":\"Plot\",\"histogramBase\":0,\"joinPoints\":false}},\"description\":\"Balance of Power\",\"shortDescription\":\"Balance of Power\",\"is_price_study\":false,\"id\":\"Balance of Power@tv-basicstudies-1\",\"scriptIdPart\":\"\",\"name\":\"Balance of Power@tv-basicstudies\",\"description_localized\":\"Balance of Power\",\"shortId\":\"Balance of Power\",\"packageId\":\"tv-basicstudies\",\"version\":\"1\",\"fullId\":\"Balance of Power@tv-basicstudies-1\",\"productId\":\"tv-basicstudies\"}}],\"leftAxisState\":{\"m_priceRange\":null,\"m_isAutoScale\":true,\"m_isPercentage\":false,\"m_isLog\":false,\"m_isLockScale\":false,\"m_height\":135,\"m_topMargin\":0.05,\"m_bottomMargin\":0.05},\"leftAxisSources\":[],\"rightAxisState\":{\"m_priceRange\":{\"m_maxValue\":1,\"m_minValue\":-1},\"m_isAutoScale\":true,\"m_isPercentage\":false,\"m_isLog\":false,\"m_isLockScale\":false,\"m_height\":135,\"m_topMargin\":0.05,\"m_bottomMargin\":0.05},\"rightAxisSources\":[\"zt9Tas\"],\"overlayPriceScales\":{},\"stretchFactor\":1000,\"mainSourceId\":\"zt9Tas\"}],\"timeScale\":{\"m_barSpacing\":4.860000000000001,\"m_rightOffset\":5},\"chartProperties\":{\"paneProperties\":{\"background\":\"#222\",\"gridProperties\":{\"color\":\"#363c4e\",\"style\":0},\"vertGridProperties\":{\"color\":\"#363c4e\",\"style\":0},\"horzGridProperties\":{\"color\":\"#363c4e\",\"style\":0},\"crossHairProperties\":{\"color\":\"rgba( 152, 152, 152, 1)\",\"style\":2,\"transparency\":0,\"width\":1},\"topMargin\":5,\"bottomMargin\":5,\"leftAxisProperties\":{\"autoScale\":true,\"autoScaleDisabled\":false,\"lockScale\":false,\"percentage\":false,\"percentageDisabled\":false,\"log\":false,\"logDisabled\":false,\"alignLabels\":true},\"rightAxisProperties\":{\"autoScale\":true,\"autoScaleDisabled\":false,\"lockScale\":false,\"percentage\":false,\"percentageDisabled\":false,\"log\":false,\"logDisabled\":false,\"alignLabels\":true},\"legendProperties\":{\"showStudyArguments\":true,\"showStudyTitles\":true,\"showStudyValues\":true,\"showSeriesTitle\":true,\"showSeriesOHLC\":true,\"showLegend\":true}},\"scalesProperties\":{\"showLeftScale\":false,\"showRightScale\":true,\"backgroundColor\":\"#ffffff\",\"lineColor\":\"#787878\",\"textColor\":\"#D9D9D9\",\"fontSize\":11,\"scaleSeriesOnly\":false,\"showSeriesLastValue\":true,\"showSeriesPrevCloseValue\":false,\"showStudyLastValue\":false,\"showSymbolLabels\":true,\"showStudyPlotLabels\":false},\"chartEventsSourceProperties\":{\"visible\":true,\"futureOnly\":true,\"breaks\":{\"color\":\"rgba(85, 85, 85, 1)\",\"visible\":false,\"style\":2,\"width\":1}}},\"version\":2,\"timezone\":\"Europe/Berlin\"}]}","is_realtime":"1"}'
                ]
            ];
        }
    }
    
    public function study_templates(Request $request)
    {
        return [
            'status' => 'ok',
            'data' => [

            ]
            ];
    }
}

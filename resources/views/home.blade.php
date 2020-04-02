@extends('layout')
@section('content')
<!-- preloader area end -->
<!-- page container area start -->
<div class="page-container">
    @include('sidebar')
    <!-- main content area start -->
    <div class="main-content">
        @include('headerarea')
        @include('titlebar')
        <div class="main-content-inner">
            <!-- sales report area start -->
            <div class="sales-report-area mt-5 mb-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-report mb-xs-30">
                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                <div class="icon"><i class="fa fa-btc"></i></div>
                                <div class="s-report-title d-flex justify-content-between">
                                    <h4 class="header-title mb-0">Bitcoin</h4>
                                    <p>24 H</p>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <h2>$ 4567809,987</h2>
                                    <span>- 45.87</span>
                                </div>
                            </div>
                            <canvas id="coin_sales1" height="100"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-report mb-xs-30">
                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                <div class="icon"><i class="fa fa-btc"></i></div>
                                <div class="s-report-title d-flex justify-content-between">
                                    <h4 class="header-title mb-0">Bitcoin Dash</h4>
                                    <p>24 H</p>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <h2>$ 4567809,987</h2>
                                    <span>- 45.87</span>
                                </div>
                            </div>
                            <canvas id="coin_sales2" height="100"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-report">
                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                <div class="icon"><i class="fa fa-eur"></i></div>
                                <div class="s-report-title d-flex justify-content-between">
                                    <h4 class="header-title mb-0">Euthorium</h4>
                                    <p>24 H</p>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <h2>$ 4567809,987</h2>
                                    <span>- 45.87</span>
                                </div>
                            </div>
                            <canvas id="coin_sales3" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sales report area end -->
            <!-- overview area start -->
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="header-title mb-0">Penjualan dan Pembelian</h4>
                                <div>
                                    <label for="date_start-0">From: </label>
                                    <input type="date" name="date_start" id="date_start-0">
                                    <label for="date_end-0">To: </label>
                                    <input type="date" name="date_end" id="date_end-0">
                                    <button id="procceed-0">Procceed</button>
                                </div>
                                <select class="custome-select border-0 pr-3" id="timerange-0">
                                    <option selected value="0">Last 24 Hours</option>
                                    <option value="1">Last Week</option>
                                    <option value="2">Last Month</option>
                                    <option value="3">Last Year</option>
                                    <option value="4">Life Time</option>
                                </select>
                            </div>
                            <div id="verview-shart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 coin-distribution">
                    <div class="card h-full">
                        <div class="card-body">
                            <h4 class="header-title mb-0">Penjualan Sales Bulan Ini</h4>
                            <div id="coin_distribution"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- overview area end -->
            <!-- market value area start -->
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h4 class="header-title mb-0">Pelanggan Terbaik</h4>
                                <select class="custome-select border-0 pr-3">
                                    <option selected>Last 24 Hours</option>
                                    <option value="0">01 July 2018</option>
                                </select>
                            </div>
                            <div class="market-status-table mt-4">
                                <div class="table-responsive">
                                    <table class="dbkit-table">
                                        <tr class="heading-td">
                                            <td class="coin-name">Coin Name</td>
                                            <td class="buy">Buy</td>
                                            <td class="sell">Sells</td>
                                            <td class="trends">Trends</td>
                                            <td class="attachments">Attachments</td>
                                            <td class="stats-chart">Stats</td>
                                        </tr>
                                        <tr>
                                            <td class="coin-name">Dashcoin</td>
                                            <td class="buy">30% <img src="assets/images/icon/market-value/triangle-down.png" alt="icon"></td>
                                            <td class="sell">20% <img src="assets/images/icon/market-value/triangle-up.png" alt="icon"></td>
                                            <td class="trends"><img src="assets/images/icon/market-value/trends-up-icon.png" alt="icon"></td>
                                            <td class="attachments">$ 56746,857</td>
                                            <td class="stats-chart">
                                                <canvas id="mvaluechart"></canvas>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- market value area end -->
            <!-- row area start -->
            <div class="row">
                <!-- Live Crypto Price area start -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Live Crypto Price</h4>
                            <div class="cripto-live mt-5">
                                <ul>
                                    <li>
                                        <div class="icon b">b</div> Bitcoin<span><i class="fa fa-long-arrow-up"></i>$876909.00</span></li>
                                    <li>
                                        <div class="icon l">l</div> Litecoin<span><i class="fa fa-long-arrow-up"></i>$29780.00</span></li>
                                    <li>
                                        <div class="icon d">d</div> Dashcoin<span><i class="fa fa-long-arrow-up"></i>$13276.00</span></li>
                                    <li>
                                        <div class="icon b">b</div> Bitcoindash<span><i class="fa fa-long-arrow-down"></i>$5684.890</span></li>
                                    <li>
                                        <div class="icon e">e</div> Euthorium<span><i class="fa fa-long-arrow-down"></i>$3890.98</span></li>
                                    <li>
                                        <div class="icon t">b</div> Tcoin<span><i class="fa fa-long-arrow-up"></i>$750.789</span></li>
                                    <li>
                                        <div class="icon b">b</div> Bitcoin<span><i class="fa fa-long-arrow-up"></i>$325.037</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Live Crypto Price area end -->
                <!-- trading history area start -->
                <div class="col-lg-8 mt-sm-30 mt-xs-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h4 class="header-title">Trading History</h4>
                                <div class="trd-history-tabs">
                                    <ul class="nav" role="tablist">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#buy_order" role="tab">Buy Order</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#sell_order" role="tab">Sell Order</a>
                                        </li>
                                    </ul>
                                </div>
                                <select class="custome-select border-0 pr-3">
                                    <option selected>Last 24 Hours</option>
                                    <option value="0">01 July 2018</option>
                                </select>
                            </div>
                            <div class="trad-history mt-4">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="buy_order" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="dbkit-table">
                                                <tr class="heading-td">
                                                    <td>Trading ID</td>
                                                    <td>Time</td>
                                                    <td>Status</td>
                                                    <td>Amount</td>
                                                    <td>Last Trade</td>
                                                </tr>
                                                <tr>
                                                    <td>78211</td>
                                                    <td>4.00 AM</td>
                                                    <td>Pending</td>
                                                    <td>$758.90</td>
                                                    <td>$05245.090</td>
                                                </tr>
                                                <tr>
                                                    <td>782782</td>
                                                    <td>4.00 AM</td>
                                                    <td>Pending</td>
                                                    <td>$77878.90</td>
                                                    <td>$7778.090</td>
                                                </tr>
                                                <tr>
                                                    <td>89675978</td>
                                                    <td>4.00 AM</td>
                                                    <td>Pending</td>
                                                    <td>$0768.90</td>
                                                    <td>$0945.090</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="sell_order" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="dbkit-table">
                                                <tr class="heading-td">
                                                    <td>Trading ID</td>
                                                    <td>Time</td>
                                                    <td>Status</td>
                                                    <td>Amount</td>
                                                    <td>Last Trade</td>
                                                </tr>
                                                <tr>
                                                    <td>8964978</td>
                                                    <td>4.00 AM</td>
                                                    <td>Pending</td>
                                                    <td>$445.90</td>
                                                    <td>$094545.090</td>
                                                </tr>
                                                <tr>
                                                    <td>89675978</td>
                                                    <td>4.00 AM</td>
                                                    <td>Pending</td>
                                                    <td>$78.90</td>
                                                    <td>$074852945.090</td>
                                                </tr>
                                                <tr>
                                                    <td>78527878</td>
                                                    <td>4.00 AM</td>
                                                    <td>Pending</td>
                                                    <td>$0768.90</td>
                                                    <td>$65465.090</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- trading history area end -->
            </div>
            <!-- row area end -->
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <footer>
        <div class="footer-area">
            <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
        </div>
    </footer>
    <!-- footer area end-->
</div>
<!-- page container area end -->
<!-- offset area start -->
<div class="offset-area">
    <div class="offset-close"><i class="ti-close"></i></div>
    <ul class="nav offset-menu-tab">
        <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
        <li><a data-toggle="tab" href="#settings">Settings</a></li>
    </ul>
    <div class="offset-content tab-content">
        <div id="activity" class="tab-pane fade in show active">
            <div class="recent-activity">
                <div class="timeline-task">
                    <div class="icon bg1">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="tm-title">
                        <h4>Rashed sent you an email</h4>
                        <span class="time"><i class="ti-time"></i>09:35</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                    </p>
                </div>
                <div class="timeline-task">
                    <div class="icon bg2">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="tm-title">
                        <h4>Added</h4>
                        <span class="time"><i class="ti-time"></i>7 Minutes Ago</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur.
                    </p>
                </div>
                <div class="timeline-task">
                    <div class="icon bg2">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <div class="tm-title">
                        <h4>You missed you Password!</h4>
                        <span class="time"><i class="ti-time"></i>09:20 Am</span>
                    </div>
                </div>
                <div class="timeline-task">
                    <div class="icon bg3">
                        <i class="fa fa-bomb"></i>
                    </div>
                    <div class="tm-title">
                        <h4>Member waiting for you Attention</h4>
                        <span class="time"><i class="ti-time"></i>09:35</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                    </p>
                </div>
                <div class="timeline-task">
                    <div class="icon bg3">
                        <i class="ti-signal"></i>
                    </div>
                    <div class="tm-title">
                        <h4>You Added Kaji Patha few minutes ago</h4>
                        <span class="time"><i class="ti-time"></i>01 minutes ago</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                    </p>
                </div>
                <div class="timeline-task">
                    <div class="icon bg1">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="tm-title">
                        <h4>Ratul Hamba sent you an email</h4>
                        <span class="time"><i class="ti-time"></i>09:35</span>
                    </div>
                    <p>Hello sir , where are you, i am egerly waiting for you.
                    </p>
                </div>
                <div class="timeline-task">
                    <div class="icon bg2">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <div class="tm-title">
                        <h4>Rashed sent you an email</h4>
                        <span class="time"><i class="ti-time"></i>09:35</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                    </p>
                </div>
                <div class="timeline-task">
                    <div class="icon bg2">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <div class="tm-title">
                        <h4>Rashed sent you an email</h4>
                        <span class="time"><i class="ti-time"></i>09:35</span>
                    </div>
                </div>
                <div class="timeline-task">
                    <div class="icon bg3">
                        <i class="fa fa-bomb"></i>
                    </div>
                    <div class="tm-title">
                        <h4>Rashed sent you an email</h4>
                        <span class="time"><i class="ti-time"></i>09:35</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                    </p>
                </div>
                <div class="timeline-task">
                    <div class="icon bg3">
                        <i class="ti-signal"></i>
                    </div>
                    <div class="tm-title">
                        <h4>Rashed sent you an email</h4>
                        <span class="time"><i class="ti-time"></i>09:35</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                    </p>
                </div>
            </div>
        </div>
        <div id="settings" class="tab-pane fade">
            <div class="offset-settings">
                <h4>General Settings</h4>
                <div class="settings-list">
                    <div class="s-settings">
                        <div class="s-sw-title">
                            <h5>Notifications</h5>
                            <div class="s-swtich">
                                <input type="checkbox" id="switch1" />
                                <label for="switch1">Toggle</label>
                            </div>
                        </div>
                        <p>Keep it 'On' When you want to get all the notification.</p>
                    </div>
                    <div class="s-settings">
                        <div class="s-sw-title">
                            <h5>Show recent activity</h5>
                            <div class="s-swtich">
                                <input type="checkbox" id="switch2" />
                                <label for="switch2">Toggle</label>
                            </div>
                        </div>
                        <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                    </div>
                    <div class="s-settings">
                        <div class="s-sw-title">
                            <h5>Show your emails</h5>
                            <div class="s-swtich">
                                <input type="checkbox" id="switch3" />
                                <label for="switch3">Toggle</label>
                            </div>
                        </div>
                        <p>Show email so that easily find you.</p>
                    </div>
                    <div class="s-settings">
                        <div class="s-sw-title">
                            <h5>Show Task statistics</h5>
                            <div class="s-swtich">
                                <input type="checkbox" id="switch4" />
                                <label for="switch4">Toggle</label>
                            </div>
                        </div>
                        <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                    </div>
                    <div class="s-settings">
                        <div class="s-sw-title">
                            <h5>Notifications</h5>
                            <div class="s-swtich">
                                <input type="checkbox" id="switch5" />
                                <label for="switch5">Toggle</label>
                            </div>
                        </div>
                        <p>Use checkboxes when looking for yes or no answers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        if ($('#mvaluechart').length) {
        var ctx = document.getElementById('mvaluechart').getContext('2d');
        var myLineChart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "Market Value",
                    backgroundColor: 'transparent',
                    borderColor: '#6e00ff',
                    borderWidth: 2,
                    data: [0, 15, 30, 10, 25, 0, 30],
                    pointBorderColor: "transparent",
                    pointBorderWidth: 10
                }]
            },

            // Configuration options go here
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.yLabel;
                        }
                    }
                },
                elements: {
                    line: {
                        tension: 0, // disables bezier curves
                    }
                },
                scales: {
                    yAxes: [{
                        display: !1
                    }],
                    xAxes: [{
                        display: !1
                    }]
                }
            }
        });
    }
        /*--------------  overview-chart start ------------*/
        if ($('#verview-shart').length) {
            var myConfig = {
                "type": "line",

                "scale-x": { //X-Axis
                    "labels": <?php echo(json_encode($labels)); ?>,
                    "label": {
                        "font-size": 14,
                        "offset-x": 0,
                    },
                    "item": { //Scale Items (scale values or labels)
                        "font-size": 10,
                    },
                    "guide": { //Guides
                        "visible": false,
                        "line-style": "solid", //"solid", "dotted", "dashed", "dashdot"
                        "alpha": 1
                    }
                },
                'scale-y': {
                    short: true
                },
                "plot": { 
                    "aspect": "spline", 
                    "tooltip": {
                        "text": "Rp %v",
                        "shadow": false,
                        "border-radius": 2,
                        'thousands-separator': "."
                    }
                },
                "legend": {
                    "background-color": "none",
                    "border-width": 0,
                    "shadow": false,
                    "layout": "float",
                    "marker": {
                        "border-radius": 3,
                        "border-width": 0
                    },
                    "item": {
                        "color": "%backgroundcolor"
                    }
                },
                "series": [{
                        "text": "Penjualan",
                        "values": <?php echo(json_encode($jml_penjualan)); ?>,
                        "line-color": "#F0B41A",
                        /* "dotted" | "dashed" */
                        "line-width": 2 /* in pixels */ ,
                        "marker": { /* Marker object */
                            "background-color": "#D79D3B",
                            /* hexadecimal or RGB value */
                            "size": 3,
                            /* in pixels */
                            "border-color": "#D79D3B",
                            /* hexadecimal or RBG value */
                        }
                    },
                    {
                        "text": "Pembelian",
                        "values": <?php echo(json_encode($jml_pembelian)); ?>,
                        "line-color": "#0884D9",
                        /* "dotted" | "dashed" */
                        "line-width": 2 /* in pixels */ ,
                        "marker": { /* Marker object */
                            "background-color": "#067dce",
                            /* hexadecimal or RGB value */
                            "size": 3,
                            /* in pixels */
                            "border-color": "#067dce",
                            /* hexadecimal or RBG value */
                        }
                    }
                ]
            };

            zingchart.render({
                id: 'verview-shart',
                data: myConfig,
                height: "100%",
                width: "100%"
            });
        }
        /*--------------  overview-chart END ------------*/
        /*--------------  coin distrubution chart START ------------*/
        if ($('#coin_distribution').length) {
        zingchart.THEME = "classic";
        var myConfig = {
            "globals": {
                "font-family": "Roboto"
            },
            "graphset": [{
                    "type": "pie",
                    "background-color": "#fff",
                    "legend": {
                        "background-color": "none",
                        "border-width": 0,
                        "shadow": false,
                        "layout": "float",
                        "margin": "auto auto 16% auto",
                        "marker": {
                            "border-radius": 3,
                            "border-width": 0
                        },
                        "item": {
                            "color": "%backgroundcolor"
                        }
                    },
                    "plotarea": {
                        "background-color": "#FFFFFF",
                        "border-color": "#DFE1E3",
                        "margin": "25% 8%"
                    },
                    "labels": [{
                        "x": "45%",
                        "y": "47%",
                        "width": "10%",
                        "text": "340 Coin",
                        "font-size": 17,
                        "font-weight": 700
                    }],
                    "plot": {
                        "size": 70,
                        "slice": 90,
                        "margin-right": 0,
                        "border-width": 0,
                        "shadow": 0,
                        "value-box": {
                            "visible": true
                        },
                        "tooltip": {
                            "text": "Rp %v",
                            "shadow": false,
                            "border-radius": 2,
                            'thousands-separator': "."
                        }
                    },
                    "series": [{
                            "values": [<?php echo($sales[0]->jml_penjualan); ?>],
                            "text": "<?php echo($sales[0]->nama); ?>",
                            "background-color": "#4cff63"
                        },
                        {
                            "values": [<?php echo($sales[1]->jml_penjualan); ?>],
                            "text": "<?php echo($sales[1]->nama); ?>",
                            "background-color": "#fd9c21"
                        },
                        {
                            "values": [<?php echo($sales[2]->jml_penjualan); ?>],
                            "text": "<?php echo($sales[2]->nama); ?>",
                            "background-color": "#2c13f8"
                        }
                    ]
                }

            ]
        };

        zingchart.render({
            id: 'coin_distribution',
            data: myConfig,
        });
        }
        /*--------------  coin distrubution chart END ------------*/
        
        $('#timerange-0').change(function() {
            if($(this).val() == 0) {
                var date = new Date();
                let endDate = date.getDate();
                if (endDate < 10) {
                    endDate = '0' + endDate;
                }
                let endMonth = date.getMonth();
                if (endMonth < 10) {
                    endMonth = '0' + endMonth;
                }
                let end = date.getFullYear() + '-' + endMonth + '-' + endDate;
                $.get('/get-penjualan-pembelian/'+end, function(data) {
                    renderGrafikPenjualanPembelian(data.jml_penjualan, data.jml_pembelian, data.labels);
                });
            }
            else if($(this).val() == 1) {
                var date = new Date();
                let endDate = date.getDate();
                if (endDate < 10) {
                    endDate = '0' + endDate;
                }
                let endMonth = date.getMonth();
                if (endMonth < 10) {
                    endMonth = '0' + endMonth;
                }
                let end = date.getFullYear() + '-' + endMonth + '-' + endDate;
                var last = new Date(date.getTime() - (7 * 24 * 60 * 60 * 1000));
                var day = last.getDate();
                var month = last.getMonth()+1;
                var year = last.getFullYear();
                let lastMonth = last.getMonth();
                if (lastMonth < 10) {
                    lastMonth = '0' + lastMonth;
                }
                let lastDate = last.getDate();
                if (lastDate < 10) {
                    lastDate = '0' + lastDate;
                }
                let start = last.getFullYear() + '-' + lastMonth + '-' + lastDate;
                $.get('/get-penjualan-pembelian/'+start+'/'+end, function(data) {
                    renderGrafikPenjualanPembelian(data.jml_penjualan, data.jml_pembelian, data.labels);
                });
            }
            else if($(this).val() == 2) {
                var date = new Date();
                let endDate = date.getDate();
                if (endDate < 10) {
                    endDate = '0' + endDate;
                }
                let endMonth = date.getMonth();
                if (endMonth < 10) {
                    endMonth = '0' + endMonth;
                }
                let end = date.getFullYear() + '-' + endMonth + '-' + endDate;
                var last = new Date(date.getTime() - (30 * 24 * 60 * 60 * 1000));
                var day = last.getDate();
                var month = last.getMonth()+1;
                var year = last.getFullYear();
                let lastMonth = last.getMonth();
                if (lastMonth < 10) {
                    lastMonth = '0' + lastMonth;
                }
                let lastDate = last.getDate();
                if (lastDate < 10) {
                    lastDate = '0' + lastDate;
                }
                let start = last.getFullYear() + '-' + lastMonth + '-' + lastDate;
                $.get('/get-penjualan-pembelian/'+start+'/'+end, function(data) {
                    renderGrafikPenjualanPembelian(data.jml_penjualan, data.jml_pembelian, data.labels);
                });
            }
            else if($(this).val() == 3) {
                var date = new Date();
                let endDate = date.getDate();
                if (endDate < 10) {
                    endDate = '0' + endDate;
                }
                let endMonth = date.getMonth();
                if (endMonth < 10) {
                    endMonth = '0' + endMonth;
                }
                let end = date.getFullYear() + '-' + endMonth + '-' + endDate;
                var last = new Date(date.getTime() - (365 * 24 * 60 * 60 * 1000));
                var day = last.getDate();
                var month = last.getMonth()+1;
                var year = last.getFullYear();
                let lastMonth = last.getMonth();
                if (lastMonth < 10) {
                    lastMonth = '0' + lastMonth;
                }
                let lastDate = last.getDate();
                if (lastDate < 10) {
                    lastDate = '0' + lastDate;
                }
                let start = last.getFullYear() + '-' + lastMonth + '-' + lastDate;
                $.get('/get-penjualan-pembelian/'+start+'/'+end, function(data) {
                    renderGrafikPenjualanPembelian(data.jml_penjualan, data.jml_pembelian, data.labels);
                });
            }
            else if($(this).val() == 4) {
                $.get('/get-penjualan-pembelian', function(data) {
                    renderGrafikPenjualanPembelian(data.jml_penjualan, data.jml_pembelian, data.labels);
                });
            }
            
        });
        $('#procceed-0').click(function() {
            if($('#date_start-0').val() && $('#date_end-0').val()) {
                if($('#date_start-0').val() < $('#date_end-0').val()) {
                    $.get('/get-penjualan-pembelian/'+$('#date_start-0').val()+'/'+$('#date_end-0').val(), function(data) {
                        renderGrafikPenjualanPembelian(data.jml_penjualan, data.jml_pembelian, data.labels);
                    });
                }
            }
        });
    });
    function renderGrafikPenjualanPembelian(v0, v1, labels) {
        var myConfig = {
            "type": "line",
            "scale-x": { //X-Axis
                "labels": labels,
                "label": {
                    "font-size": 14,
                    "offset-x": 1,
                },
                "item": { //Scale Items (scale values or labels)
                    "font-size": 10,
                },
                "guide": { //Guides
                    "visible": false,
                    "line-style": "solid", //"solid", "dotted", "dashed", "dashdot"
                    "alpha": 1
                }
            },
            'scale-y': {
                short: true
            },
            "plot": { 
                "aspect": "spline", 
                "tooltip": {
                    "text": "Rp %v",
                    "shadow": false,
                    "border-radius": 2,
                    'thousands-separator': "."
                }
            },
            "legend": {
                "background-color": "none",
                "border-width": 0,
                "shadow": false,
                "layout": "float",
                "marker": {
                    "border-radius": 3,
                    "border-width": 0
                },
                "item": {
                    "color": "%backgroundcolor"
                }
            },
            "series": [{
                    "text": "Penjualan",
                    "values": v0,
                    "line-color": "#F0B41A",
                    /* "dotted" | "dashed" */
                    "line-width": 2 /* in pixels */ ,
                    "marker": { /* Marker object */
                        "background-color": "#D79D3B",
                        /* hexadecimal or RGB value */
                        "size": 3,
                        /* in pixels */
                        "border-color": "#D79D3B",
                        /* hexadecimal or RBG value */
                    }
                },
                {
                    "text": "Pembelian",
                    "values": v1,
                    "line-color": "#0884D9",
                    /* "dotted" | "dashed" */
                    "line-width": 2 /* in pixels */ ,
                    "marker": { /* Marker object */
                        "background-color": "#067dce",
                        /* hexadecimal or RGB value */
                        "size": 3,
                        /* in pixels */
                        "border-color": "#067dce",
                        /* hexadecimal or RBG value */
                    }
                }
            ]
        };

        zingchart.render({
            id: 'verview-shart',
            data: myConfig,
            height: "100%",
            width: "100%"
        });
    }
</script>
@endsection
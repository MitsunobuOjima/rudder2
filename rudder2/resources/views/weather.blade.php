<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>









<div class="panel-heading border-light">
  <h3 class="panel-title">
    <i class="livicon" data-name="dashboard" data-size="18" data-color="white" data-hc="white"
       data-l="true"></i>
    お天気データ
  </h3>
</div>
<div class="panel-body">
  <div class="table-responsive">
    <div>
      <ul id="container"></ul>
    </div>
  </div>
</div>


<div class="panel-body">
  <div class="table-responsive">
    <table class="table table-bordered " id="sensers">
      <thead>
        <tr class="filters">
          <th>日付</th>
          <th>気温(℃)</th>
          <th>湿度(%)</th>
          <th>気圧(hPa)</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>


<!--  Highcharts-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/modules/exporting.js"></script>
 
<!--  dataTable-->
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>




function datestring(daydata) {
console.log("start datestring!");
var date = new Date();
date.setDate(date.getDate() + daydata);
var year = date.getFullYear();
var month = (1 + date.getMonth()).toString();
month = month.length > 1 ? month : '0' + month;
var day = date.getDate().toString();
day = day.length > 1 ? day : '0' + day;
var hours = date.getHours().toString();
var convday = year + '-' + month + '-' + day;
console.log("datestring! : " + convday + ' ' + hours);
return  convday;
};
 
 
$(function () {
var name = "hoge";
var options = {
chart: {
renderTo: 'container', 　
        type: 'spline',
        zoomType: 'x'
        },
        title: {
        text: '気象データ in 横浜'
        },
        subtitle: {
        text: '提供: TomoSoft（https://tomosoft.jp/design/）'
        },
        credits: {
        enabled: false
        },
        xAxis: [{
        title: {
        text: '時刻',
        },
                categories: ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00',
                        '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00',
                        '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'],
                crosshair: true
        }],
        yAxis: [{// Primary yAxis
        title: {
        text: '気温',
                style: {
                color: '#228B22', //ForestGreen
                }
        },
                labels: {
                format: '{value}℃',
                        style: {
                        color: '#228B22',
                        }
                },
                ceiling: 35,
                floor: - 10
 
        }, {// Secondary yAxis 
        gridLineWidth: 0,
                title: {
                text: '湿度',
                        style: {
                        color: '#4169E1', //RoyalBlue
                        }
                },
                labels: {
                format: '{value} %',
                        style: {
                        color: '#4169E1',
                        }
                },
                ceiling: 90,
                floor: 20,
                opposite: true
 
        }, {// Tertiary yAxis
        gridLineWidth: 0,
                title: {
                text: '気圧',
                        style: {
                        color: '#DAA520', // GoldenRod
                        }
                },
                labels: {
                format: '{value} hPa',
                        style: {
                        color: '#DAA520',
                        }
                },
                ceiling: 1030,
                floor: 990,
                opposite: true
        }],
        tooltip: {
        formatter: function () {
        var s = this.x;
        s += '<br/>' + '<span style="color:#228B22;">' + this.points[2].series.name + '</span>' + ': ' +
                this.points[2].y + '℃';
        s += '<br/>' + '<span style="color:#4169E1;">' + this.points[1].series.name + '</span>' + ': ' +
                this.points[1].y + '%';
        s += '<br/>' + '<span style="color:#DAA520;">' + this.points[0].series.name + '</span>' + ': ' +
                this.points[0].y + 'hPa';
        return s;
        },
                shared: true
        },
        exporting: {
        buttons: {
        customButton: {
        text: '昨日',
                onclick: function () {
                alert('昨日');
                $.getJSON('{!! route('chartdata') !!}', {"datedata": datestring( - 1)}, function (data) {
                options.series[2].data = data[0];
                options.series[1].data = data[1];
                options.series[0].data = data[2];
                var chart = new Highcharts.Chart(options);
                });
                }
        },
                anotherButton: {
                text: '今日',
                        onclick: function () {
                        alert('今日');
                        $.getJSON('{!! route('chartdata') !!}', {"datedata": datestring(0)}, function (data) {
                        options.series[2].data = data[0];
                        options.series[1].data = data[1];
                        options.series[0].data = data[2];
                        var chart = new Highcharts.Chart(options);
                        });
                        }
                }
        }
        },
        legend: {
        layout: 'vertical',
                align: 'left',
                x: 80,
                verticalAlign: 'top',
                y: 35,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: [{
        name: '気圧',
                type: 'column',
                yAxis: 2,
                color: '#DAA520',
                data: [1016, 1016, 1015.9, 1015.5, 996.3, 1009.5, 1009.6, 1010.2, 1013.1, 1016.9, 1018.2, 1016.7, 1016, 1016, 1015.9, 1015.5, 1012.3, 1009.5, 995.6, 1010.2, 1013.1, 1000.9, 1018.2, 1016.7],
                legendIndex: 2,
                marker: {
                enabled: false
                },
                dashStyle: 'shortdot',
                tooltip: {
                valueSuffix: ' hPa'
                }
        }, {
        name: '湿度',
                type: 'spline',
                yAxis: 1,
                color: '#4169E1',
                data: [45.9, 71.5, 50.4, 50.2, 55.0, 60.0, 70.6, 60.5, 70.4, 63.1, 70.6, 54.4, 49.9, 71.5, 50.4, 50.2, 45.0, 50.0, 70.6, 60.5, 62.4, 50.1, 75.6, 54.4],
                legendIndex: 1,
                tooltip: {
                valueSuffix: ' %'
                }
 
        }, {
        name: '気温',
                type: 'spline',
                yAxis: 0,
                color: '#228B22',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                legendIndex: 0,
                tooltip: {
                valueSuffix: ' ℃'
                }
        }]
        };
$.getJSON('{!! route('chartdata') !!}', {"datedata": datestring(0)}, function (data) {
options.series[2].data = data[0];
options.series[1].data = data[1];
options.series[0].data = data[2];
var chart = new Highcharts.Chart(options);
});
});
 
　　　　・・・
 
$(function () {
var table = $('#sensers').DataTable({
lengthMenu: [10],
        displayLength: 11,
        // 件数切替機能 無効
        lengthChange: false,
        // 検索機能 無効
        searching: false,
        // 情報表示 無効
        info: false,
        processing: true,
        serverSide: true,
        ajax:{
        "url"  :"{!! route('tabledata') !!}",
                data: { "datedata" : datestring(0) }
        },
        columns: [
        {data: 'created_at', name: 'created_at', format: 'M/D/YYYY'},
        {data: 'temperature', name: 'temperature'},
        {data: 'humidity', name: 'humidity'},
        {data: 'pressure', name: 'pressure'},
        ]
        });
});







            </div>
        </div>
    </body>
</html>

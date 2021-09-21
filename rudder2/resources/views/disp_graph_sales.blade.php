@extends('adminlte::page')

@section('title', '売上分析')

@section('content_header')
    <h1>売上分析</h1>
@stop

@section('content')
                <div class="" style="">
                    <form id="disp_sales_data" method="POST" action="">
                        <input type="hidden" name="hoge" value="fuga" />
                        @csrf
{{--
                        <input type="checkbox" name="selectedBrands[]" value="7" />
--}}
                        <div class="margin: 20px 0;">

                        @foreach($value as $key => $val)
                            <div class="" style="background-color:#e6e6fa;width:20%;float:left;text-align:left;">
                            <input type="checkbox" name="selectedBrands[]" value="{{$val->id}}" />{{$val->name}}
{{--
                            {{Form::checkbox('selectedBrands[]', $val->id, false, ['class'=>'custom-control-input'])}} {{$val->name}}
--}}
                            </div>
                        @endforeach

                        </div>

                        <div style="margin: 20px 0;">
                        期間
                        <select class="form-control widthselect" name="fromyear" style="background-color:#e6e6fa;width:20%;float:left;text-align:left;">
                        <option value="">---</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021" selected="">2021</option>
                        </select>
                        <label class="float-left textlabel">&nbsp;年</label>
                        <select class="form-control widthselect" name="frommonth" style="background-color:#e6e6fa;width:20%;float:left;text-align:left;">
                        <option value="">---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9" selected="">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        </select>
                        <label class="float-left textlabel">&nbsp;月</label>
                        <label class="float-left textlabel distance">&nbsp;~</label>
                        <select class="form-control widthselect" name="toyear" style="background-color:#e6e6fa;width:20%;float:left;text-align:left;">
                        <option value="">---</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021" selected="">2021</option>
                        </select>
                        <label class="float-left textlabel">&nbsp;年</label>
                        <select class="form-control widthselect" name="tomonth" style="background-color:#e6e6fa;width:20%;float:left;text-align:left;">
                        <option value="">---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9" selected="">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        </select>
                        <label class="float-left textlabel">&nbsp;月</label>
                        </div>

                        {{Form::submit('表示', ['class'=>'btn btn-primary btn-block'])}}
                    </form>
                </div>

                <ul id="container"></ul>

                <div class="" style="background-color: #00ff99;">
                    <table border="1">
                        <tr>
{{--
                            <th>date</th>
                            <th>sale_cumulative</th>
--}}
                            <th>日付</th>
                            <th>Session</th>
                            <th>CV</th>
                            <th>CVR</th>
                            <th>AOV</th>
                            <th>売上合計</th>
                            <th>プロパー売上</th>
                            <th>セール売上</th>
                            <th>売上予算</th>
                            <th>売上予測</th>
                            <th>プロパー在庫数</th>
                            <th>セール在庫数</th>
                            <th>新規EC会員数</th>
                        </tr>
                        @foreach ($arrOrderData as $book)
                        <tr>
                            <td>{{ $book->date }}</td>
                            <td>{{ number_format($book->session) }}</td>
                            <td>{{ number_format($book->cv) }}</td>
                            <td>{{ $book->cvr }}</td>
                            <td>{{ $book->aov }}</td>
                            <td>{{ number_format($book->sale_cumulative) }}</td>
                            <td>{{ number_format($book->proper_sale) }}</td>
                            <td>{{ number_format($book->total_sale) }}</td>
                            <td>{{ number_format($book->sale_budget) }}</td>
                            <td>{{ number_format($book->sale_forecast) }}</td>
                            <td>{{ number_format($book->stock_global) }}</td>
                            <td>{{ number_format($book->stock_sale) }}</td>
                            <td>{{ number_format($book->number_new_customer) }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
@stop

@section('css')
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}
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
@stop

@section('js')
    <script> console.log('ページごとJSの記述'); </script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script>
      $(function () {
        var name = "hoge";
        var options = {
          chart: {
            renderTo: 'container', 　
                    type: 'spline',
            zoomType: 'x'
          },
          title: {
            text: 'ブランド合算売上データ'
          },
          subtitle: {
            text: ''
          },
          credits: {
            enabled: false
          },
          xAxis: [{
              title: {
                text: '日付',
              },
              categories: @json(isset($arrTargetDate) ? $arrTargetDate: [], JSON_PRETTY_PRINT),
              crosshair: true
            }],
          yAxis: [{// Primary yAxis
              title: {
                text: '売上予測',
                style: {
                  color: '#228B22', //ForestGreen
                }
              },
              labels: {
                format: '{value}円',
                style: {
                  color: '#228B22',
                }
              },
              ceiling: {{$total_product_max_value}},
              floor: -10
 
            }, {// Tertiary yAxis
              gridLineWidth: 0,
              title: {
                text: '売上実績',
                style: {
                  color: '#DAA520', // GoldenRod
                }
              },
              labels: {
                format: '{value} 円',
                style: {
                  color: '#DAA520',
                }
              },
              ceiling: {{$total_product_max_value}},
              floor: 990,
              opposite: true
            }],
          tooltip: {
            formatter: function () {
              var s = this.x;
 
              s += '<br/>' + '<span style="color:#228B22;">' + this.points[1].series.name + '</span>' + ': ' +
                      this.points[2].y + '円';

              s += '<br/>' + '<span style="color:#DAA520;">' + this.points[0].series.name + '</span>' + ': ' +
                      this.points[0].y + '円';
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
                }
              },
              anotherButton: {
                text: '今日',
                onclick: function () {
                  alert('今日');
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
              name: '売上実績',
              type: 'column',
              yAxis: 1,
              color: '#DAA520',
              data: @json(isset($arrTotalProduct) ? $arrTotalProduct: [], JSON_PRETTY_PRINT),
              legendIndex: 2,
              marker: {
                enabled: false
              },
              dashStyle: 'shortdot',
              tooltip: {
                valueSuffix: ' 円'
              }
            }, {
              name: '売上予測',
              type: 'spline',
              yAxis: 0,
              color: '#228B22',
              data: @json(isset($arrMovingAverage) ? $arrMovingAverage: [], JSON_PRETTY_PRINT),
              legendIndex: 0,
              tooltip: {
                valueSuffix: ' 円'
              }
            }]
        };
<!--
//series: @json(isset($form['arrSeri']) ? $form['arrSeri']: [], JSON_PRETTY_PRINT),
-->

//          var yesterday = "2016/07/29";
        console.log("start env!");
 
        var date = new Date();
        var year = date.getFullYear();
        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : '0' + month;
        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
        var yesterday = year + '/' + month + '/' + day;
        console.log("start env1! : " + yesterday);
 
        var date = new Date();
        var year = date.getFullYear();
        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : '0' + month;
        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
        var yesterday = year + '/' + month + '/' + day;
 
        $.getJSON("res.php", {"yesterday_date": yesterday}, function (data) {
          //console.log("start env2! : " + data[0] + " " + data[1] + " " + data[2]);
          //console.log("start env2! : " + data);

        var arrHoge = @json(isset($arrMovingAverage) ? $arrMovingAverage: [], JSON_PRETTY_PRINT);
        var arrFuga = @json(isset($arrTotalProduct) ? $arrTotalProduct: [], JSON_PRETTY_PRINT);

//          options.series[1].data = data[0];
          options.series[1].data = arrHoge;
//          options.series[1].data = data[1];
//          options.series[0].data = data[2];
          options.series[0].data = arrFuga;
          var chart = new Highcharts.Chart(options);
        });
        console.log("start env3! : ");
/*
//        options.series[1].data = @json(isset($arrTargetDate) ? $arrTargetDate: [], JSON_PRETTY_PRINT);
//        options.series[0].data = @json(isset($arrTotalProduct) ? $arrTotalProduct: [], JSON_PRETTY_PRINT);
//        var chart = new Highcharts.Chart(options);
*/
        console.log("start env4! : ");
 
      });
    </script>
@stop

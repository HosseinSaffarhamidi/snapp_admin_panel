@extends('layouts.admin')

@section('content')

        <div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">داشبورد</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" style="direction: rtl">



                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-hand-o-right fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $today_service_count }}</div>
                                    <div>تعداد سرویس های انجام شده امروز</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('admin/service/final') }}">
                            <div class="panel-footer">
                                <span class="pull-left">‌نمایش بیشتر</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6" >
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-hand-o-right fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $service_count }}</div>
                                    <div>تعداد کل سرویس های انجام شده</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('admin/service/final') }}">
                            <div class="panel-footer">
                                <span class="pull-left">نمایش بیشتر</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6" >
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $user_count }}</div>
                                    <div>تعداد کاربران</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('admin/user') }}">
                            <div class="panel-footer">
                                <span class="pull-left">نمایش بیشتر</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" >
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-car fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $driver_count }}</div>
                                    <div>تعداد راننده ها</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('admin/driver') }}">
                            <div class="panel-footer">
                                <span class="pull-left">نمایش بیشتر</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>




            <div class="row" style="margin-top: 40px">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            میزان درآمد ماه جاری
                        </div>


                        <div class="panel-body">
                            <div class="table-responsive">

                                <div  id="container" style="margin:20px"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row" style="margin-top: 40px">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            آمار کارکرد اپلیکیشن
                        </div>


                        <div class="panel-body">
                            <div class="table-responsive">
                                <div id="container2"></div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          آمار کلی درآمد اپلیکیشن
                        </div>


                        <div class="panel-body">
                            <div class="table-responsive">
                               <table class="table table-bordered">
                                   <tr>
                                       <td style="width:200px">مبلغ کل کار کرد</td>
                                       <td>{{ number_format($total_price) }}  ریال</td>
                                   </tr>

                                   <tr>
                                       <td>مبلغ کل کارمزد </td>
                                       <td>{{ number_format($total_wage) }}  ریال</td>
                                   </tr>


                                   <tr>
                                       <td>مبلغ قابل واریز به راننده ها</td>
                                       <td>{{ number_format($total_payment) }}  ریال</td>
                                   </tr>


                                   <tr>
                                       <td>مبلغ بدهی راننده ها</td>
                                       <td>{{ str_replace('-','',number_format($driver_debit)) }}  ریال</td>
                                   </tr>

                               </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>



@endsection


@section('footer')

<script type="text/javascript" src="{{ url('js/highcharts.js') }}"></script>
<script>
    Highcharts.chart('container', {

        title: {
            text: ''
        },
        chart:{
            type:'line',
            style:{
                fontFamily:'IRANSansWeb'
            }
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        legend: {
            verticalAlign: 'top'
        },
        xAxis:{
          categories:[<?= $date_array ?>]
        },
        series: [{
            name: 'کارمزد',
            data: [<?= $wage ?>]
        }, {
            name: 'هزینه سفرها',
            data: [<?= $price ?>],
            color:'red',
            marker:{
                symbol:'circle'
            }
        }],
        tooltip:{
            formatter:function () {
                return this.x+'<br>'+this.series.name+' : '+this.y+' ریال';
            }
        },
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });


    Highcharts.chart('container2', {
        chart: {
            type: 'pie',
            style:{
                fontFamily:'IRANSansWeb'
            }
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name} {point.y:.1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span>{point.name}</span> <b>{point.y:.2f}</b> از کل سرویس ها<br/>'
        },

        series: [
            {
                name: "",
                colorByPoint: true,
                data: [
                    {
                        name: "سرویس های انجام شده %",
                        y: <?= $final_service ?>,
                    },
                    {
                        name: "سرویس های لغو شده توسط راننده %",
                        y: <?= $driver_cancel ?>,
                    },
                    {
                        name: "سرویس های لغو شده توسط کاربر %",
                        y:<?= $user_cancel ?>,
                    }
                    ,
                    {
                        name: "سرویس های فاقد راننده %",
                        y: <?= $driver_request ?>,
                    }
                ]
            }
        ],
    });
</script>
@endsection

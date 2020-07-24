@extends('layouts.admin')

@section('content')

    <div class="row" style="margin-top: 40px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   اطلاعات سفر
                </div>



                <div class="panel-body">
                    <div class="table-responsive">
                        @if(Session::has('status'))
                            <div class="alert alert-success">{{ Session::get('status') }}</div>
                        @endif
                        <table class="table table-striped table-bordered table-hover">

                            <tr>
                                <td style="width: 200px">
                                    مبدا سفر
                                </td>
                                <td>
                                    {{ $service->address1 }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 200px">
                                    مقصد اول
                                </td>
                                <td>
                                    {{ $service->address2 }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 200px">
                                    مقصد دوم
                                </td>
                                <td>
                                    {{ $service->address3 }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 200px">
                                   هزینه کل
                                </td>
                                <td>
                                    {{ number_format($service->total_price) .' ریال' }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 200px">
                                    هزینه قابل واریز
                                </td>
                                <td>
                                    {{ number_format($service->price) .' ریال' }}
                                </td>
                            </tr>


                            <tr>
                                <td>مدت توقف در مسیر</td>
                                <td>{{ $service->stop_time }}</td>
                            </tr>

                            <tr>
                                <td>وضعیت مسیر</td>
                                <td>
                                    @if($service->going_back=='ok')
                                        دو طرفه
                                        @else
                                        یک طرفه
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 200px">
                                    نام راننده
                                </td>
                                <td>
                                    {{ $service->get_driver->name}}
                                </td>
                            </tr>


                            <tr>
                                <td style="width: 200px">
                                    شماره تماس راننده
                                </td>
                                <td>
                                    {{ $service->get_driver->mobile}}
                                </td>
                            </tr>
                        </table>


                        @if($service->driving_status==1)
                            <div style="margin-top: 10px;margin-bottom:20px;text-align:center">

                                <button class="btn btn-warning" onclick="change_status(-2,'<?= $service->_id ?>')">لغو سفر توسط راننده</button>

                                <button class="btn btn-primary" onclick="change_status(-3,'<?= $service->_id ?>')">لغو سفر توسط کاربر</button>

                            </div>
                        @endif

                        <div id='map' style='width: 100%; height: 300px;'></div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row" style="margin-top: 40px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  رویداد های سفر
                </div>


                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">


                            <tr>
                                <th>ردیف</th>
                                <th>وضعیت</th>
                                <th>زمان رویداد</th>
                                <th>فاصله از نقطه مورد نظر</th>
                            </tr>
                            <?php $i=1; $Jdf=new \App\lib\Jdf(); ?>
                            <?php $status=\App\Service::get_status($service) ?>
                            @foreach($service->getServiceStatus as $key=>$value)

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        @if(array_key_exists($value->status,$status))
                                             {{ $status[$value->status] }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $Jdf->jdate(' H:i:s',$value->time) }}
                                    </td>
                                    <td>
                                        @if($value->status==2)
                                            {{ \App\Service::getDistanceBetweenPoints($value->lat,$value->lng,$service->lat1,$service->lng1).' متر' }}
                                        @endif

                                        @if($value->status==3)
                                            {{ \App\Service::getDistanceBetweenPoints($value->lat,$value->lng,$service->lat1,$service->lng1).' متر' }}
                                        @endif

                                        @if($value->status==4)
                                            {{ \App\Service::getDistanceBetweenPoints($value->lat,$value->lng,$service->lat2,$service->lng2).' متر' }}
                                        @endif

                                        @if($value->status==5 && $service->going_back=="no")
                                            {{ \App\Service::getDistanceBetweenPoints($value->lat,$value->lng,$service->lat3,$service->lng3).' متر' }}
                                        @endif

                                        @if($value->status==5 && $service->going_back=="ok")
                                            {{ \App\Service::getDistanceBetweenPoints($value->lat,$value->lng,$service->lat1,$service->lng1).' متر' }}
                                        @endif

                                        @if($value->status==6)
                                          {{ \App\Service::getDistanceBetweenPoints($value->lat,$value->lng,$service->lat1,$service->lng1).' متر' }}
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </table>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('header')
 <link href="{{ url('css/cedarmaps.css') }}" rel="stylesheet">
@endsection

@section('footer')
    <script type="text/javascript" src="{{ url('js/cedarmaps.js') }}"></script>
    <script type="text/javascript">
        var lat1='<?= $service->lat1 ?>';
        var lng1='<?= $service->lng1 ?>';

        var lat2='<?= $service->lat2 ?>';
        var lng2='<?= $service->lng2 ?>';

        var lat3='<?= $service->lat3 ?>';
        var lng3='<?= $service->lng3 ?>';


        L.cedarmaps.accessToken = '<?= \App\lib\Setting::cedarMapToken() ?>';

        // Getting maps info from a tileJSON source
        var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;

        // initilizing map into div#map
        var map = L.cedarmaps.map('map', tileJSONUrl, {
            scrollWheelZoom: true
        }).setView([lat1, lng1], 14);


        var myIcon = L.icon({
            iconUrl: '<?= url('images/map_marker.png') ?>',
            iconSize: [45, 45]
        });
        var myIcon2 = L.icon({
            iconUrl: '<?= url('images/destination_marker.png') ?>',
            iconSize: [45, 45]
        });

        L.marker([lat1,lng1],{icon: myIcon}).addTo(map);
        L.marker([lat2,lng2],{icon: myIcon2}).addTo(map);
        L.marker([lat3,lng3],{icon: myIcon2}).addTo(map);


        var direction = L.cedarmaps.direction();
        var latlng=lat1+","+lng1+";"+lat2+","+lng2;
        if(lat3.trim()!="")
        {
            latlng=latlng+";"+lat3+","+lng3;
        }
        direction.route('cedarmaps.driving', latlng, function(err, json) {
            var RouteGeometry = json.result.routes[0].geometry;

            var RouteLayer = L.geoJSON(RouteGeometry, {
                // for more styling options check out:
                // https://leafletjs.com/reference-1.3.0.html#path-option
                style: function(feature) {
                    return {
                        color: '#f00',
                        weight: 5
                    }
                }
            }).addTo(map);

            map.fitBounds(RouteLayer.getBounds());
        });
        change_status=function (status,id)
        {
            var message="آیا از لغو سفر توسط";
            if(status==-2){
                message=message+" راننده اطمینان دارید؟"
            }
            else{
                message=message+" کاربر اطمینان دارید؟"
            }
            var token='<?= Session::token() ?>';
            var route='<?= url('admin/service/change_status') ?>'+"/"+id;
            if (!confirm(message))
                return false;
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action",route);

            var hiddenField1 = document.createElement("input");
            hiddenField1.setAttribute("name", "status");
            hiddenField1.setAttribute("value",status);
            form.appendChild(hiddenField1);

            var hiddenField2 = document.createElement("input");
            hiddenField2.setAttribute("name", "_token");
            hiddenField2.setAttribute("value",token);
            form.appendChild(hiddenField2);
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    </script>
@endsection

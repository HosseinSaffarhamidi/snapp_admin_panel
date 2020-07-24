@extends('layouts.admin')

@section('content')

    <div class="row" style="margin-top: 40px">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                   موقعیت راننده ها
                </div>


                <div class="panel-body">
                    <div class="table-responsive">

                        <div id='map' style='width: 100%; height: 400px;'></div>
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
    <script type="text/javascript" src="{{ url('js/leaflet.rotatedMarker.js') }}"></script>
    <script type="text/javascript">


        var lat='38.0412';
        var lng='46.3993';
        L.cedarmaps.accessToken = '<?= \App\lib\Setting::cedarMapToken() ?>';

        // Getting maps info from a tileJSON source
        var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;

        // initilizing map into div#map
        var map = L.cedarmaps.map('map', tileJSONUrl, {
            scrollWheelZoom: true
        }).addControl(L.cedarmaps.geocoderControl('cedarmaps.streets',{
            keepOpen:false,
            autocomplete:true
        })).setView([lat, lng], 16);

        var status='غیر فعال';
        var myIcon = L.icon({
            iconUrl: '<?= url('images/car_marker.png') ?>',
            iconSize: [15, 25]
        });

        var marker_list=new Array();

        map.on('moveend',function (e)
        {
            lat=e.target.getCenter().lat;
            lng=e.target.getCenter().lng;

            $.ajaxSetup(
                {
                    'headers':{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({

                type:'POST',
                url:'<?= url('admin/map/get_driver_location') ?>',
                data:'lat='+lat+'&'+'lng='+lng,
                success:function (data)
                {
                    remover_marker();
                    r=0;
                    var list=$.parseJSON(data);
                    for(var t=0;t<list.length;t++)
                    {
                       var lat1=list[t].location.coordinates[0];
                       var lng1=list[t].location.coordinates[1];
                       var Angle=list[t].angle;
                       var name=list[t].name;
                        if(list[t].status_driver=='on')
                        {
                            status='فعال';
                        }
                        else if(list[t].status_driver=='driving')
                        {
                            status='در حال انجام سرویس';
                        }
                        else if(list[t].status_driver=='off')
                        {
                            status='غیر فعال';
                        }
                        var tooltip_message=name+" "+status;

                        var maker=L.marker([lat1,lng1],{icon: myIcon, rotationAngle:Angle})
                            .bindTooltip('<div class="Tooltip_message">'+tooltip_message+'</div>').addTo(map);
                        marker_list[r]=maker;
                        r++;
                    }


                }
            });
        });


        r=0;
        <?php
        foreach ($driver_list as $key=>$value)
            {
                ?>
                var driver_lat='<?= $value->location["coordinates"][0] ?>';
                var driver_lng='<?= $value->location["coordinates"][1] ?>';
                var Angle='<?= $value->angle ?>';
                var name='<?= $value->name ?>';
                var driver_status='<?= $value->status_driver ?>';
                if(driver_status=='on')
                {
                    status='فعال';
                }
                else if(driver_status=='driving')
                {
                    status='در حال انجام سرویس';
                }
                else if(driver_status=='off')
                {
                    status='غیر فعال';
                }
                 tooltip_message=name+" "+status;

                var marker=L.marker([driver_lat,driver_lng],{icon: myIcon, rotationAngle:Angle})
                    .bindTooltip('<div class="Tooltip_message">'+tooltip_message+'</div>').addTo(map);
                marker_list[r]=marker;
                r++;
        <?php
            }
        ?>

        //map.show();

        remover_marker=function ()
        {
            for (var i=0;i<marker_list.length;i++)
            {
                marker_list[i].remove();
            }
        };



    </script>
@endsection
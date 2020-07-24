@extends('layouts.admin')


@section('content')

    <div class="row" style="margin-top: 40px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   افزودن منطقه جدید
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">


                    <div id="map" style="width:100%;height:300px;margin-bottom:20px"></div>
                    {!! Form::open(['url' =>url('admin/location')]) !!}

                    <input type="hidden" name="lat" id="lat" value="38.0412">
                    <input type="hidden" name="lng" id="lng" value="46.3993">


                    <div class="form-group">
                        {!! Form::label('name', 'نام منطقه : '); !!}
                        {!! Form::text('name',null,['class'=>'input']); !!}


                        @if($errors->has('name'))
                            <p class="has_error">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('radius', 'شعاع : '); !!}
                        {!! Form::text('radius',100,['class'=>'input','id'=>'radius']); !!}


                        @if($errors->has('radius'))
                            <p class="has_error">{{ $errors->first('radius') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('fixed_price', 'هزینه ثابت : ') !!}
                        {!! Form::text('fixed_price',null,['class'=>'input','id'=>'radius']); !!}


                        @if($errors->has('fixed_price'))
                            <p class="has_error">{{ $errors->first('fixed_price') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('price', 'هزینه  هر کیلومتر : ') !!}
                        {!! Form::text('price',null,['class'=>'input','id'=>'radius']); !!}


                        @if($errors->has('price'))
                            <p class="has_error">{{ $errors->first('price') }}</p>
                        @endif
                    </div>

                    <p>تعیین هزینه در بازه های زمانی خاص</p>


                    <div class="form-group">
                        <input type="text" class="input small" name="time1[]" placeholder="8">
                        <span> تا </span>
                        <input type="text" class="input small" name="time2[]" placeholder="10">
                        -
                        <input type="text" class="input small" name="time_price[]" placeholder="500 تومان">
                    </div>

                    <div id="time_box"></div>
                    <span class="fa fa-plus" onclick="add_time_input()"></span>



                    <div class="form-group">
                        <button class="btn btn-success">ثبت</button>
                    </div>
                         {{ Form::close() }}
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

        var marker=L.marker([lat,lng],{
            draggable:true
        }).addTo(map);

        var radius=document.getElementById('radius').value;
        var b=L.circle([lat,lng],{radius:radius}).addTo(map);

        marker.on("dragend",function (event)
        {
            radius=document.getElementById('radius').value;
            map.removeLayer(b);
           var position=event.target.getLatLng();
            b=L.circle([position.lat,position.lng],{radius:radius}).addTo(map);
            document.getElementById('lat').value=position.lat;
            document.getElementById('lng').value=position.lng;
        });

        map.on("click",function (event)
        {
           marker.setLatLng(event.latlng);
            radius=document.getElementById('radius').value;
            map.removeLayer(b);
            var position=event.latlng;
            b=L.circle([position.lat,position.lng],{radius:radius}).addTo(map);
            document.getElementById('lat').value=position.lat;
            document.getElementById('lng').value=position.lng;
        });


        add_time_input=function () {

            var html='<div class="form-group">' +
                '<input type="text" class="input small" name="time1[]" placeholder="8">' +
                '<span> تا </span>' +
                '<input type="text" class="input small" name="time2[]" placeholder="10">' +
                ' - ' +
                '<input type="text" class="input small" name="time_price[]" placeholder="500 تومان">' +
                '</div>';
            $("#time_box").append(html);
        };
        $("#radius").on("keyup",function (event) {

            var r=$(this).val();
            b.setRadius(r);
        });
    </script>
@endsection

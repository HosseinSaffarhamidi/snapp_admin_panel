@extends('layouts.admin')


@section('content')

    <div class="row" style="margin-top: 40px">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعیین هزینه سفرها
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form action="{{ url('admin/setting/location/price') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>هزینه ثابت : </label>
                            <input type="text" name="fixed_price" value="{{ $fixed_price }}" class="input" placeholder="1500 تومان">
                        </div>
                        <p class="has_error">
                            @if($errors->has('fixed_price'))
                                {{ $errors->first('fixed_price') }}
                            @endif
                        </p>

                        <div class="form-group">
                            <label>هزینه  هر کیلومتر : </label>
                            <input type="text" name="price" value="{{ $price }}" class="input" placeholder="500 تومان">
                        </div>

                        <p class="has_error">
                            @if($errors->has('fixed_price'))
                                {{ $errors->first('fixed_price') }}
                            @endif
                        </p>
                        <p>تعیین هزینه در بازه های زمانی خاص</p>

                        @foreach($time_limit_price as $key=>$value)

                            <div class="form-group">
                                <input type="text" class="input small" value="{{ $value['time1'] }}" name="time1[]" placeholder="8">
                                <span> تا </span>
                                <input type="text" class="input small" value="{{ $value['time2'] }}" name="time2[]" placeholder="10">
                                -
                                <input type="text" class="input small" value="{{ $value['time_price'] }}" name="time_price[]" placeholder="500 تومان">
                            </div>
                        @endforeach
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<script>
    add_time_input=function () {

        var html='<div class="form-group">' +
            '<input type="text" class="input small" name="time1[]" placeholder="8">' +
            '<span> تا </span>' +
            '<input type="text" class="input small" name="time2[]" placeholder="10">' +
            ' - ' +
            '<input type="text" class="input small" name="time_price[]" placeholder="500 تومان">' +
            '</div>';
        $("#time_box").append(html);
    }
</script>
@endsection
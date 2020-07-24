@extends('layouts.admin')


@section('content')

    <div class="row" style="margin-top: 40px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   افزودن راننده جدید
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

    {!! Form::model($driver,['url' =>url('admin/driver/'.$driver->_id),'files'=>true]) !!}


    {{ method_field('PUT') }}

    <div class="form-group">
        {!! Form::label('name', 'نام راننده: '); !!}
        {!! Form::text('name',null,['class'=>'input']); !!}


        @if($errors->has('name'))
            <p class="has_error">{{ $errors->first('name') }}</p>
        @endif
    </div>


    <div class="form-group">
        {!! Form::label('mobile', 'شماره موبایل: '); !!}
        {!! Form::text('mobile',null,['class'=>'input']); !!}
        @if($errors->has('mobile'))
            <p class="has_error">{{ $errors->first('mobile') }}</p>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('password', 'کلمه عبور: '); !!}
        {!! Form::password('password',['class'=>'input']); !!}
        @if($errors->has('password'))
             <p class="has_error">{{ $errors->first('password') }}</p>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('car_type', 'نوع ماشین: '); !!}
        {!! Form::text('car_type',null,['class'=>'input']); !!}
        @if($errors->has('car_type'))
            <p class="has_error">{{ $errors->first('car_type') }}</p>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('car_type', 'پلاک ماشین : '); !!}
        {!! Form::text('code_number_plates',null,['class'=>'input input2','placeholder'=>'کد منطقه']); !!}
        {!! Form::text('city_code',null,['class'=>'input input2','placeholder'=>'کد پلاک']); !!}
        {!! Form::text('number_plates',null,['class'=>'input input2','placeholder'=>'حرف']); !!}
        {!! Form::text('city_number',null,['class'=>'input input2','placeholder'=>'کد شهر']); !!}

        @if($errors->has('code_number_plates'))
            <p class="has_error">{{ $errors->first('code_number_plates') }}</p>
        @endif
        @if($errors->has('city_code'))
            <p class="has_error">{{ $errors->first('city_code') }}</p>
        @endif
        @if($errors->has('number_plates'))
            <p class="has_error">{{ $errors->first('number_plates') }}</p>
        @endif  @if($errors->has('city_number'))
            <p class="has_error">{{ $errors->first('city_number') }}</p>
        @endif

    </div>

    <div class="form-group">

        {!! Form::label('status', 'وضعیت راننده : '); !!}
        {{ Form::select('status', ['no' => 'غیر فعال', 'ok' => 'فعال']) }}
    </div>

    <div class="form-group">
        {!! Form::label('img', 'تصویر راننده : '); !!}
         {{ Form::file('img') }}
    </div>
    @if($errors->has('img'))
          <p class="has_error">{{ $errors->first('img') }}</p>
    @endif
    <div class="form-group">
        <button type="submit" class="btn btn-primary">ویرایش</button>
    </div>
    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

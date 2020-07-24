@extends('layouts.admin')


@section('content')

    <div class="row" style="margin-top: 40px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ایجاد اعلان جدید
                </div>


                <?php

                $group=array();
                $group['all']='همه';
                $group['user']='مسافر';
                $group['driver']='راننده';

                ?>
                <div class="panel-body">

                    {!! Form::open(['url' =>url('admin/notification'),'files'=>true]) !!}


                    <div class="form-group">
                        {!! Form::label('title', 'عنوان اعلان: '); !!}
                        {!! Form::text('title',null,['class'=>'input']); !!}


                        @if($errors->has('title'))
                            <p class="has_error">{{ $errors->first('title') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('content', 'توضیحات اعلان: '); !!}
                        {!! Form::textArea('content',null,['class'=>'input']); !!}
                        @if($errors->has('content'))
                            <p class="has_error">{{ $errors->first('content') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('activity', 'اکتیویتی: '); !!}
                        {!! Form::text('activity',null,['class'=>'input','style'=>'text-align:left']); !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('group', 'ارسال به : '); !!}
                        {!! Form::select('group',$group,'all',['class'=>'input']); !!}

                    </div>

                    <div class="form-group">
                        {!! Form::label('activity_key', 'اسم پارامتری ارسالی : '); !!}
                        {!! Form::text('activity_key',null,['class'=>'input','style'=>'text-align:left']); !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('activity_value', 'مقدار پارامتر ارسالی: '); !!}
                        {!! Form::text('activity_value',null,['class'=>'input','style'=>'text-align:left']); !!}
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">ثبت</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

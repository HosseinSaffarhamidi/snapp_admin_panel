@extends('layouts.admin')


@section('content')

    <div class="row" style="margin-top: 40px">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ویرایش حساب کاربری
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="has-error" style="padding-top: 10px;padding-bottom:10px"> {{ Session::get('msg') }}</div>
                    {!! Form::open(['url' =>url('admin/profile')]) !!}


                    <div class="form-group">
                        {!! Form::label('name', 'نام : '); !!}
                        {!! Form::text('name',Auth::user()->name,['class'=>'input']); !!}


                        @if($errors->has('name'))
                            <p class="has_error">{{ $errors->first('name') }}</p>
                        @endif
                    </div>


                    <div class="form-group">
                        {!! Form::label('email', 'ایمیل: '); !!}
                        {!! Form::text('email',Auth::user()->email,['class'=>'input']); !!}
                        @if($errors->has('email'))
                            <p class="has_error">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('username', 'نام کاربری: '); !!}
                        {!! Form::text('username',Auth::user()->username,['class'=>'input']); !!}
                        @if($errors->has('username'))
                            <p class="has_error">{{ $errors->first('username') }}</p>
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
                        {!! Form::label('password_confirmation', 'تکرار کلمه عبور: '); !!}
                        {!! Form::password('password_confirmation',['class'=>'input']); !!}
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">ویرایش</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
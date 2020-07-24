<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ورود به بخش مدیریت</title>
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/admin.css') }}" rel="stylesheet">
</head>
<body>


<div class="login_box">

    <div class="header_login">
        <h4>ورود به بخش مدیریت</h4>
    </div>
    <form method="post" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <span>نام کاربری</span>
            <input type="text" value="{{ old('username') }}" class="form-control" name="username" placeholder="UserName">
            @if($errors->has('username'))
                <span class="has-error">{{ $errors->first('username') }}</span>
            @endif
        </div>


        <div class="form-group">
            <span>کلـــمه عبــور</span>
            <input type="password" class="form-control" name="password" placeholder="Password">
            @if($errors->has('password'))
                <span class="has-error">{{ $errors->first('password') }}</span>
            @endif
        </div>




        <div class="form-group">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> مرا به خاطر بسپار

        </div>

        <div class="form-group">
            <input type="submit" style="width:150px" class="btn" value="ورود به بخش مدیریت">
        </div>


    </form>

</div>

</body>
</html>
@extends('layouts.admin')

@section('content')
    <div class="row" style="margin-top: 40px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   محتوای اعلان
                </div>

            <?php

            $group=array();
            $group['all']='همه';
            $group['user']='مسافر';
            $group['driver']='راننده';

            ?>
            <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">

                            <tbody>
                            <?php  $Jdf=new \App\lib\Jdf() ?>
                            </tbody>

                            <tr>
                                <td style="width: 150px">عنوان اعلان</td>
                                <td>{{ $notification->title }}</td>
                            </tr>

                            <tr>
                                <td style="width: 150px">توضیحات اعلان</td>
                                <td>{{ $notification->content }}</td>
                            </tr>

                            <tr>
                                <td style="width: 150px">زمان ارسال</td>
                                <td> {{ $Jdf->jdate('H:i:s / Y-n-j',$notification->time) }}</td>
                            </tr>

                            <tr>
                                <td style="width: 150px">اکتیویتی</td>
                                <td> {{ $notification->activity }}</td>
                            </tr>

                            <tr>
                                <td>ارسال به </td>
                                <td>
                                    @if(array_key_exists($notification->group,$group))
                                        {{ $group[$notification->group] }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>نام پارامتر ارسالی</td>
                                <td> {{ $notification->activity_key }}</td>
                            </tr>

                            <tr>
                                <td>مقدار پارامتر ارسالی</td>
                                <td> {{ $notification->activity_value }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


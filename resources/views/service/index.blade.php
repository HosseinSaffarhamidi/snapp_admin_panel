@extends('layouts.admin')

@section('content')
<div class="row" style="margin-top: 40px">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               مدیریت سرویس های در حال انجام
            </div>
            <?php

            $array=array();
            $array[-2]="لغو سفر توسط مسافر";
            $array[-1]="در انتظار راننده";
            $array[1]="قبول درخواست توسط راننده";
            $array[2]="رسیدن راننده به مبدا";
            $array[3]="سوار شدن مسافر";
            $array[4]="رسیدن به مقصد اول";
            $array[5]="رسیدن به مقصد دوم";
            ?>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شناسه سفر</th>
                            <th>نام راننده</th>
                            <th>زمان ثبت</th>
                            <th>هزینه سفر</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; $Jdf=new \App\lib\Jdf() ?>

                        @foreach($services as $key=>$value)
                            <tr>
                                <td>{{ $i }}</td>
                                <td style="color: blue">{{ $value->order_id }}</td>
                                <td>{{ $value->get_driver->name }}</td>
                                <td>
                                    {{ $Jdf->jdate(' H:i:s  / Y-n-j',$value->time) }}
                                </td>
                                <td>{{ number_format($value->price).' ریال' }}</td>
                                <td>
                                    @if(array_key_exists($value->status,$array))
                                        <span class="btn btn-danger">
                                        {{ $array[$value->status] }}
                                        </span>
                                    @endif
                                </td>
                                <td>

                                    <a href="{{ url('admin/service').'/'.$value->_id }}">
                                        <span class="fa fa-eye"></span>
                                    </a>
                                    <span class="fa fa-remove" onclick="del_row('<?= $value->_id ?>')"></span>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>


                    {{ $services->links() }}
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

</div>
@endsection


@section('footer')
<script>
    del_row=function (id)
    {
        var token='<?= Session::token() ?>';
        var route='<?= url('admin/service') ?>'+"/"+id;
        if (!confirm("آیا از حذف این رکورد اطمینان دارید !"))
            return false;
        var form = document.createElement("form");
        form.setAttribute("method", "POST");
        form.setAttribute("action",route);

        var hiddenField1 = document.createElement("input");
        hiddenField1.setAttribute("name", "_method");
        hiddenField1.setAttribute("value",'DELETE');
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




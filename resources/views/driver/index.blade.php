@extends('layouts.admin')

@section('content')
<div class="row" style="margin-top: 40px">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                مدیریت راننده ها
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر راننده</th>
                            <th>نام راننده</th>
                            <th>شماره موبایل</th>
                            <th>میزان اعتبار راننده</th>
                            <th>تاریخ عضویت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; $Jdf=new \App\lib\Jdf() ?>
                        @foreach($drivers as $key=>$value)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    @if(empty($value->driver_pic))
                                        <img src="{{ url('images/default.jpg') }}" class="driver_pic">

                                    @else
                                        <img src="{{ url($value->driver_pic) }}" class="driver_pic">

                                    @endif
                                </td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->mobile }}</td>
                                <td>
                                    {{ number_format($value->inventory) }} ریال
                                </td>
                                <td>
                                   {{ $Jdf->tr_num($Jdf->jdate('Y-n-j',$value->created_time)) }}
                                </td>
                                <td>
                                    @if($value->status=='ok')
                                        <span class="btn btn-success">فعال</span>
                                    @else
                                       <span class="btn btn-danger"> غیر فعال</span>
                                    @endif
                                </td>
                                <td>

                                    <a href="{{ url('admin/driver').'/'.$value->_id.'/edit' }}">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                    <span class="fa fa-remove" onclick="del_row('<?= $value->_id ?>')"></span>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>


                    {{ $drivers->links() }}
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
        var route='<?= url('admin/driver') ?>'+"/"+id;
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




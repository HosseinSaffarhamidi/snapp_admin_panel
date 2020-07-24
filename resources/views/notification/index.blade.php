@extends('layouts.admin')

@section('content')
    <div class="row" style="margin-top: 40px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    مدیریت اعلان ها
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
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>زمان ارسال</th>
                                <th>وضعیت</th>
                                <th>گروه</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; $Jdf=new \App\lib\Jdf() ?>
                            @foreach($notification as $key=>$value)

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>
                                        {{ $Jdf->jdate('H:i:s Y-n-j',$value->time) }}
                                    </td>
                                    <td>
                                        @if($value->status=='ok')
                                            <span class="btn btn-success">
                                                  ارسال شده
                                            </span>

                                        @else
                                            <span class="btn btn-danger">
                                                خطا در ارسال
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(array_key_exists($value->group,$group))
                                            {{ $group[$value->group] }}
                                        @endif
                                    </td>
                                    <td>

                                        <a href="{{ url('admin/notification').'/'.$value->_id }}">
                                            <span class="fa fa-eye"></span>
                                        </a>
                                        <span class="fa fa-remove" onclick="del_row('<?= $value->_id ?>')"></span>

                                    </td>
                                </tr>

                                <?php $i++ ?>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $notification->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        del_row=function (id)
        {
            var token='<?= Session::token() ?>';
            var route='<?= url('admin/notification') ?>'+"/"+id;
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

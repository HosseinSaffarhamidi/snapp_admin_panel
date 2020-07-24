@extends('layouts.admin')

@section('content')
    <div class="row" style="margin-top: 40px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    مدیریت مناطق
                </div>



                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام منطقه</th>
                                <th>شعاع</th>
                                <th>هزینه ثابت</th>
                                <th>هزینه بر حسب کیلومتر</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($location as $key=>$value)

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->radius }}</td>
                                    <td>{{ number_format($value->fixed_price).' تومان' }}</td>
                                    <td>{{ number_format($value->price).' تومان' }}</td>

                                    <td>

                                        <a href="{{ url('admin/location').'/'.$value->_id.'/edit' }}">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <span class="fa fa-remove" onclick="del_row('<?= $value->_id ?>')"></span>

                                    </td>
                                </tr>

                                <?php $i++ ?>
                            @endforeach
                            </tbody>
                        </table>


                        {{ $location->links() }}
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
            var route='<?= url('admin/location') ?>'+"/"+id;
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

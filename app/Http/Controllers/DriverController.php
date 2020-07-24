<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Http\Requests\DriverRequest;
use Illuminate\Http\Request;
use DB;
class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $drivers=Driver::OrderBy('created_time','DESC')->paginate(10);
        return view('driver.index',['drivers'=>$drivers]);
    }
    public function create()
    {
        return view('driver.create');
    }
    public function store(DriverRequest $request)
    {
       $Driver=new Driver($request->all());
       $Driver->password=password_hash($request->get('password'),PASSWORD_BCRYPT);
       $Driver->created_time=time();
       $Driver->inventory=0;
       $Driver->angle=90;
       if($request->hasFile('img'))
       {
           $file_name=md5($request->file('img')->getClientOriginalName().time()).'.'.$request->file('img')->getClientOriginalExtension();
           if($request->file('img')->move('upload',$file_name))
           {
               $Driver->driver_pic='upload/'.$file_name;
           }
       }
       $Driver->save();
       return redirect('admin/driver');
    }
    public function edit($id)
    {
        $driver=Driver::findOrFail($id);
        return view('driver.update',['driver'=>$driver]);
    }
    public function update($id,DriverRequest $request)
    {
        $data=$request->all();
        $driver=Driver::findOrFail($id);
        if($request->hasFile('img'))
        {
            $file_name=md5($request->file('img')->getClientOriginalName().time()).'.'.$request->file('img')->getClientOriginalExtension();
            var_dump($file_name);
            if($request->file('img')->move('upload',$file_name))
            {
                $driver->driver_pic='upload/'.$file_name;
            }
        }
        if(!empty($request->get('password'))){
            $data['password']=password_hash($request->get('password'),PASSWORD_BCRYPT);
        }else{
            $data['password']=$driver->password;
        }

        $driver->update($data);

        return redirect('admin/driver');
    }
    public function destroy($id){

        $driver=Driver::findOrFail($id);
        $driver->delete();
        return redirect('admin/driver');
    }

}

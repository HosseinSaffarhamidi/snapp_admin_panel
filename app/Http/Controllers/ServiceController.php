<?php

namespace App\Http\Controllers;

use App\Queue;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $services=Service::with('get_driver')
            ->orderBy('time','DESC')
            ->whereIn('driving_status',[0,1])
            ->whereNotIn('status',["-2","-3"])
            ->paginate(10);

        return view('service.index',['services'=>$services]);
    }
    public function destroy($id)
    {
        $service=Service::where('_id',$id)->firstOrFail();
        $service->delete();
        return redirect('admin/service');
    }
    public function show($id)
    {
        $service=Service::with(['get_driver','getServiceStatus'])->where('_id',$id)->firstOrFail();
        return view('service.show',['service'=>$service]);
    }
    public function finalService()
    {
        $services=Service::with('get_driver')
            ->orderBy('time','DESC')
            ->where('driving_status',2)
            ->paginate(10);
        return view('service.final',['services'=>$services]);
    }
    public function canceled()
    {
        $services=Service::with('get_driver')
            ->orderBy('time','DESC')
            ->whereIn('status',["-2","-3"])
            ->paginate(10);
        return view('service.canceled',['services'=>$services]);
    }
    public function chancel($id,Request $request)
    {
        $value=['id'=>$id,'status'=>$request->get('status')];
        $queue=new Queue();
        $queue->type='chancel_service';
        $queue->value=$value;
        $queue->save();
        return redirect()->back()->with('status','تغییر وضعیت سرویس با موفقیت انجام شد');
    }
}

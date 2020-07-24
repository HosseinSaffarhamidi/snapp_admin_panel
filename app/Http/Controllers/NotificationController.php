<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Notification;
use App\Server;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notification=Notification::orderBy('time','DESC')->paginate(10);
        return view('notification.index',['notification'=>$notification]);
    }

    public function create()
    {
        return view('notification.create');
    }
    public function store(NotificationRequest $request)
    {
        $notification=new Notification($request->all());
        $notification->time=time();
        if($notification->save())
        {
            $result=Server::sendNotification($notification->_id);
            if($result=='ok')
            {
                $notification->status='ok';
                $notification->update();
            }
        }
        return redirect('admin/notification');
    }
    public function show($id)
    {
        $notification=Notification::findOrFail($id);
        return view('notification.show',['notification'=>$notification]);
    }
    public function destroy($id)
    {
        $notification=Notification::findOrFail($id);
        $notification->delete();
        return redirect()->back();
    }
}

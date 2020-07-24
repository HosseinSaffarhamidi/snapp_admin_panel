<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaRequest;
use App\Location;
use Illuminate\Http\Request;
use DB;
class LocationController extends Controller
{
    public function index()
    {
        $location=Location::orderBy('time','DESC')->paginate(10);
        return view('location.index',['location'=>$location]);
    }
    public function create()
    {
        return view('location.create');
    }
    public function store(AreaRequest $request)
    {
        $lat=$request->get('lat');
        $lng=$request->get('lng');
        settype($lat,'double');
        settype($lng,'double');
        $array=array();
        $array['coordinates'][0]=$lat;
        $array['coordinates'][1]=$lng;
        $array['type']='Point';
        $Location=new Location($request->all());
        $Location->time=time();
        $Location->location=$array;
        $Location->save();
        $time1=$request->get('time1');
        $time2=$request->get('time2');
        $time_price=$request->get('time_price');

        if(is_array($time1) && is_array($time2) && is_array($time_price))
        {
            foreach ($time1 as $key=>$value)
            {
                if(is_numeric($value) && is_numeric($time2[$key]) && is_numeric($time_price[$key]))
                {
                    DB::collection('time_limit_price')
                        ->insert([
                            'time1'=>$value,
                            'time2'=>$time2[$key],
                            'time_price'=>$time_price[$key],
                            'area_id'=>$Location->id
                        ]);
                }
            }
        }

        return redirect('admin/location');
    }
    public function edit($id)
    {
        $location=Location::findOrFail($id);
        $time_limit_price=DB::collection('time_limit_price')->where('area_id',$location->id)->get();
        return view('location.edit',['location'=>$location,'time_limit_price'=>$time_limit_price]);
    }
    public function update(AreaRequest $request,$id)
    {
        $location=Location::findOrFail($id);
        $location->update($request->all());

        $time1=$request->get('time1');
        $time2=$request->get('time2');
        $time_price=$request->get('time_price');

        if(is_array($time1) && is_array($time2) && is_array($time_price))
        {
            DB::collection('time_limit_price')->where('area_id',$location->id)->delete();

            foreach ($time1 as $key=>$value)
            {
                if(is_numeric($value) && is_numeric($time2[$key]) && is_numeric($time_price[$key]))
                {
                    DB::collection('time_limit_price')
                        ->insert([
                            'time1'=>$value,
                            'time2'=>$time2[$key],
                            'time_price'=>$time_price[$key],
                            'area_id'=>$location->id
                        ]);
                }
            }
        }
        return redirect('admin/location');
    }
    public function destroy($id)
    {
        $location=Location::findOrFail($id);
        $location->delete();
        DB::collection('time_limit_price')->where('area_id',$location->id)->delete();
        return redirect()->back();
    }
}

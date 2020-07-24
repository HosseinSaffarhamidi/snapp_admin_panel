<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\Driver;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\PriceLocationRequest;
use App\lib\Jdf;
use App\Service;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user_count=AppUser::count();
        $driver_count=Driver::count();
        $service_count=Service::where('driving_status',2)->count();

        $jdf=new Jdf();
        $today=$jdf->tr_num($jdf->jdate('Y')).'-'.$jdf->tr_num($jdf->jdate('n')).'-'.$jdf->tr_num($jdf->jdate('j'));

        $today_service_count=Service::where(['driving_status'=>2,
            'date'=>$today])->count();

        $y=$jdf->tr_num($jdf->jdate('Y'));
        $m=$jdf->tr_num($jdf->jdate('n'));
        $t=$jdf->tr_num($jdf->jdate('t'));
        $wage="";
        $price="";
        $date_array="";
        for($i=1;$i<=$t;$i++)
        {
            $date=$y.'-'.$m.'-'.$i;
            $w=Service::where(['date'=>$date,'driving_status'=>2])->sum('wage');
            $p=Service::where(['date'=>$date,'driving_status'=>2])->sum('price');
            $wage.=$w;
            $price.=$p;
            $date_array.="'$date'";
            if($i!=$t){
                $date_array.=',';
                $wage.=',';
                $price.=',';
            }
        }


        $final_service=Service::where('driving_status',2)->count();
        $driver_cancel=Service::where('status',"-2")->count();
        $user_cancel=Service::where('status',"-3")->count();
        $driver_request=Service::where('status',"-1")->count();

        $count=$final_service+$driver_cancel+$user_cancel+$driver_request;
        if($final_service>0){
            $final_service=($final_service/$count)*100;
            $driver_cancel=($driver_cancel/$count)*100;
            $user_cancel=($user_cancel/$count)*100;
            $driver_request=($driver_request/$count)*100;
        }

        $total_wage=Service::where(['driving_status'=>2])->sum('wage');
        $total_price=Service::where(['driving_status'=>2])->sum('price');
        $total_payment=Driver::where('inventory','>',0)->sum('inventory');
        $driver_debit=Driver::where('inventory','<',0)->sum('inventory');
        return view('admin.index',[
            'user_count'=>$user_count,
            'driver_count'=>$driver_count,
            'service_count'=>$service_count,
            'today_service_count'=>$today_service_count,
            'wage'=>$wage,
            'price'=>$price,
            'date_array'=>$date_array,
            'final_service'=>$final_service,
            'driver_cancel'=>$driver_cancel,
            'user_cancel'=>$user_cancel,
            'driver_request'=>$driver_request,
            'total_wage'=>$total_wage,
            'total_price'=>$total_price,
            'total_payment'=>$total_payment,
            'driver_debit'=>$driver_debit
        ]);
    }
    public function map()
    {
        $driver_list = Driver::select(['location','angle','status_driver','name'])->where('location', 'near', [
            '$geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    38.0412,
                    46.3993,
                ],
            ],
            '$maxDistance' => 500,
        ])->get();

        return view('admin.map',['driver_list'=>$driver_list]);
    }
    public function get_driver_location(Request $request)
    {
        $lat=$request->get('lat');
        $lng=$request->get('lng');
        settype($lat,'double');
        settype($lng,'double');
        $driver_list = Driver::select(['location','angle','status_driver','name'])->where('location', 'near', [
            '$geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $lat,
                    $lng,
                ],
            ],
            '$maxDistance' => 500,
        ])->get()->toArray();

        return json_encode($driver_list);

    }
    public function profile()
    {

        return view('admin.profile');
    }
    public function update_profile(AdminRequest $request)
    {
        $data=$request->all();
        $user_id= Auth::user()->_id;
        $user=User::findOrFail($user_id);
        if(!empty(trim($request->get('password'))))
        {
            $data['password']=Hash::make($request->get('password'));
        }
        else
        {
            $data['password']=$user->password;
        }
        $user->update($data);

        return redirect()->back()->with(['msg'=>'ویرایش اطلاعات با موفقیت انجام شد']);
    }
    public function location_price()
    {
        $time_limit_price=DB::collection('time_limit_price')->where('area_id','0')->get();
        $fixed_price=Setting::get_setting_value('fixed_price');
        $price=Setting::get_setting_value('price');
        return view('admin.location_price',
            [
                'fixed_price'=>$fixed_price,
                'price'=>$price,
                'time_limit_price'=>$time_limit_price
            ]);

    }
    public function set_location_price(PriceLocationRequest $request)
    {
        $fixed_price=$request->get('fixed_price');
        $price=$request->get('price');

        Setting::set_setting('fixed_price',$fixed_price);
        Setting::set_setting('price',$price);

        $time1=$request->get('time1');
        $time2=$request->get('time2');
        $time_price=$request->get('time_price');

        if(is_array($time1) && is_array($time2) && is_array($time_price))
        {
            DB::collection('time_limit_price')->where('area_id','0')->delete();
            foreach ($time1 as $key=>$value)
            {
                if(is_numeric($value) && is_numeric($time2[$key]) && is_numeric($time_price[$key]))
                {
                    DB::collection('time_limit_price')
                        ->insert([
                            'time1'=>$value,
                            'time2'=>$time2[$key],
                            'time_price'=>$time_price[$key],
                            'area_id'=>'0'
                        ]);
                }
            }
        }

        return redirect()->back();
    }
}

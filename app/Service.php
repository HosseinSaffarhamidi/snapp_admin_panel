<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Service extends Eloquent
{
    protected $collection = 'services';
    protected $fillable=['driver_id'];
    public $timestamps=false;

    public function get_driver()
    {
        return $this->hasOne(Driver::class,'_id','driver_id')->withDefault(['name'=>'','mobile'=>'']);
    }
    public function getServiceStatus()
    {
        return $this->hasMany(Status::class,'service_id','_id');
    }
    public static function get_status($service)
    {
        $array=array();
        $array[-3]="لغو سفر توسط مسافر";
        $array[-2]="لغو سفر توسط راننده";
        $array[-1]="در انتظار راننده";
        $array[1]="قبول درخواست توسط راننده";
        $array[2]="رسیدن راننده به مبدا";
        $array[3]="سوار شدن مسافر";
        $array[4]="رسیدن به مقصد اول";
        $array[5]="رسیدن به مقصد دوم";
        $array[6]="پایان سفر";

        if($service->status==4 && $service->going_back=="no"){
            $array[4]="پایان سفر";
        }
        if($service->status==5){
            $array[5]="پایان سفر";
        }

        return $array;
    }

    public static function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        return $kilometers*1000;
    }

}

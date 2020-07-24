<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Driver extends Eloquent
{
    protected $collection = 'drivers';
    protected $fillable=['name','mobile','car_type','code_number_plates','city_code','number_plates','city_number','created_time',
        'status','driver_pic','password','inventory','angle'];
    public $timestamps=false;
}

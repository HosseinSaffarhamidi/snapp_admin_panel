<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Service extends Eloquent
{
    protected $collection = 'services';
    protected $fillable=[];
    public $timestamps=false;

    public function get_driver()
    {
        return $this->hasOne(Driver::class,'_id','driver_id')->withDefault(['name'=>'','mobile'=>'']);
    }
}

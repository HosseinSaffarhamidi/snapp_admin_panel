<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Location extends Eloquent
{
    protected $collection='location';
    protected $fillable=['name','radius','fixed_price','price','time','location'];
    public $timestamps=false;

}

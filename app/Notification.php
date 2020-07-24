<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Notification extends Eloquent
{
    protected $collection = 'notifications';
    public $timestamps=false;
    protected $fillable=['title','content','activity','group','activity_key',
        'activity_value','status','time'];
}

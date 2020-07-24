<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Queue extends Eloquent
{
    protected $collection = 'queue';
    public $timestamps=false;
    protected $fillable=['type','value'];
}

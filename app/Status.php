<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Status extends Eloquent
{
    protected $collection = 'servicestatuses';
    protected $fillable = [];
    public $timestamps = false;
}
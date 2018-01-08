<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlHash extends Model
{
    protected $table = 'url_hash';
    protected $fillable = ['url', 'hash'];
    public $timestamps = false;
    //
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class RabbitMessage extends Authenticatable
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'messages';
    public $timestamps = true;

    protected $fillable = [
        'message'
    ];
}

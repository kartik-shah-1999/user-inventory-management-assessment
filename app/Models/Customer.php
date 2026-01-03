<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['uuid', 'name', 'email', 'password'];
    protected $hidden = ['password'];
    protected $primaryKey = 'uuid';
    public $incrementing = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = ['uuid', 'name', 'email', 'password', 'is_online', 'last_seen_at'];
    protected $hidden = ['password'];
    protected $primaryKey = 'uuid';
    public $incrementing = false;
}

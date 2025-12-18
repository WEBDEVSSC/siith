<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    protected $table = 'user_logins';

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'logged_in_at',
    ];

    public $timestamps = true;
}

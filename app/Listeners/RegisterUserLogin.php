<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\UserLogin;
use Illuminate\Support\Facades\Request;

class RegisterUserLogin
{
    public function handle(Login $event)
    {
        UserLogin::create([
            'user_id'      => $event->user->id,
            'ip_address'   => Request::ip(),
            'user_agent'   => request()->userAgent(),
            'logged_in_at' => now(),
        ]);
    }
}
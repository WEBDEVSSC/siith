<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    //
    public function settingsShow()
    {
        return view('settings.show');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ProfesionalExtraer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemSettingsController extends Controller
{
    //
    public function settingsShow()
    {
        return view('settings.show');
    }
}

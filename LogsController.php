<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use DB;
use App\Models\LogTrail;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        $logs = DB::table('setting_log_trail')
                    ->leftjoin('setting_modul','setting_modul.id','setting_log_trail.modul_id')
                    ->leftjoin('setting_menu','setting_menu.id','setting_log_trail.modul_id')
                    ->leftjoin('setting_submenu','setting_submenu.id','setting_log_trail.modul_id')
                    ->select('setting_log_trail.*',
                             'setting_modul.label','setting_modul.icon',
                             'setting_menu.label','setting_menu.icon',
                             'setting_submenu.label','setting_submenu.icon')
                    ->get();

        return view('settings.logs.index', compact('logs'));
    }

    /**
     * Log Audit
     */
    public function log($modul_id, $modul_type, $row)
    {
        $logs = $this->audit->log($modul_id, $modul_type, $row);

        return view('settings.logs.show', compact('logs'));
    }
}

<?php

/**
* Library Audit Log & Audit Trail
 * audit log : mencatat semua perubahan dalam aplikasi
 */

namespace App\Libraries;

use DB;
use App\Models\Settings\LogTrail;

class AuditLogTrail
{
    public $model_name;
    public $table_name;

    public function initial($model_name, $table_name)
    {
        $this->model_name = $model_name;
        $this->table_name = $table_name;
    }

    public static function methodName($is)
    {
        $method = array_slice(explode('\\', $is), -1, 1);
        $method_name = explode('::', $method[0]);
        return $method_name[1];
    }

    public function logs($id = NULL)
    {
        return LogTrail::create([
                            'model'         => $this->model($this->model_name),
                            'event'         => $this->methodName(__METHOD__),
                            'event_detail'  => $this->eventJson($this->model($this->table_name), $id),
                            // 'description'   => $desc,
                            'user_id'       => \Auth::user()->id,
                            'modul_id'      => $this->modul(url()->current())[0],
                            'modul_type'    => $this->modul(url()->current())[1],
                        ]);
    }

    public function log($modul_id, $modul_type, $row)
    {
        $log = DB::table('setting_log_trail')
                    ->where('modul_id', $modul_id)
                    ->where('modul_type', $modul_type)
                    ->where('row', $row)
                    ->get();

        return $log;
    }

    public function model($model)
    {
        $model_name = array_slice(explode('\\', $model), -1, 1);
        return $model_name[0];
    }

    public function eventJson($table, $id)
    {
        $data = \DB::table($table)
                    ->where('id', $id)
                    ->first();

        $event_detail = collect($data)->except(['created_at', 'updated_at','deleted_at']);

        return json_encode($event_detail);
    }

    public static function modul($path)
    {
        $path_name = array_slice(explode('/', $path), -1, 1);
        // $link = $path_name[0];
        $link = \Request::segment(3);

        // is modul
        if(\DB::table('setting_modul')->where('link', $link)->exists()) {
            $modul_id   = \DB::table('setting_modul')->where('link', $link)->first()->id;
            $modul_type = 'modul';
        }
        // is menu
        elseif(\DB::table('setting_menu')->where('link', $link)->exists()) {
            $modul_id   = \DB::table('setting_menu')->where('link', $link)->first()->id;
            $modul_type = 'menu';
        }
        // is submenu
        elseif(\DB::table('setting_submenu')->where('link', $link)->exists()) {
            $modul_id   = \DB::table('setting_submenu')->where('link', $link)->first()->id;
            $modul_type = 'submenu';
        }
        // default
        else {
            $modul_id   = NULL;
            $modul_type = NULL;
        }

        return array($modul_id, $modul_type);
    }

}

 ?>

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'table';
    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function getTableName()
    {
        return $this->table;
    }
    public function getModelName()
    {
        return __CLASS__;
    }
}

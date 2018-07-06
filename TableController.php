<?php

namespace App\Http\Controllers;

use AuditLogTrail;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    protected $audit;
    public function __construct()
    {
        $this->middleware('auth');
        // instance object
        $obj            = new Table();
        $this->export   = new ImportExport;
        // audit log
        $this->audit = new AuditLogTrail();
        $model_name = $obj->getModelName();
        $table_name = $obj->getTableName();
        $this->audit->initial($model_name, $table_name);
    }


    public function store(Request $request)
    {
        Table::create([
            'name'     => $request->name,
        ]);

        // audit log
        $this->audit->logs("create", Table::all()->last()->id);

         return  redirect()->back();
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorTipe  $tipeVendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        Table::where('id', $table->id)
        ->update([
            'name'     => $request->name,
        ]);

        // audit log
        $this->audit->logs("update", $table->id);

         return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorTipe  $tipeVendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        Table::destroy($table->id);

        // audit log
        $this->audit->logs("delete", $table->id);

        return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TableStoreRequest;
use App\Models\Table;

class TableController extends Controller
{
 
    public function index()
    {
        $tables = Table::all();
        return view('admin.tables.index',compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(TableStoreRequest $request)
    {
        Table::create([
         'name'=>$request->name,
         'guest_number'=>$request->guest_number,
         'status'=>$request->status,
         'location'=>$request->location
        ]);

        return to_route('admin.tables.index')->with('success','Table created successfully');
    }

    public function show($id)
    {
        //
    }


    public function edit(Table $table)
    {
        return view('admin.tables.edit',compact('table'));
    }

    public function update(TableStoreRequest $request,Table $table)
    {
        $table->update($request->validated());
        return to_route('admin.tables.index')->with('success','Table updated successfully'); 
    }

    public function destroy(Table $table)
    {
        $table->delete();
        $table->reservations()->delete();  
        return to_route('admin.tables.index')->with('danger','Table deleted successfully');
    }
}

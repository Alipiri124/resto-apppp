<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Table;
use App\Http\Requests\ReservationStoreRequest;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Enums\TableStatus;
use Illuminate\Support\Carbon;
class ReservationController extends Controller
{

    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservation.index',compact('reservations'));
    }

    public function create()
    {
        $tables=Table::where('status',TableStatus::Avalaiable)->get();
        return view('admin.reservation.create',compact('tables'));
    }

    public function store(ReservationStoreRequest $request)
    {
       $table = Table::findOrfail($request->table_id);
       if($request->guest_number > $table->guest_number)
       {
          return back()->with('warning','Please choose the table base on guests.');
       }
       $request_date=Carbon::parse($request->res_date);
       foreach ($table->reservations as $res)
       {
        if ($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
            return back()->with('warning','This table is reserved for this date.');
        }
       }

       Reservation::create($request->validated());

       return to_route('admin.reservation.index')->with('success','Reservation created successfully');

    }

    public function show($id)
    {
        //
    }

    public function edit(Reservation $reservation)
    {
        $tables=Table::where('status',TableStatus::Avalaiable)->get();
        return view('admin.reservation.edit',compact('reservation','tables'));
    }

    public function update(ReservationStoreRequest $request,Reservation $reservation)
    {
         $table = Table::findOrfail($request->table_id);
       if($request->guest_number > $table->guest_number)
       {
          return back()->with('warning','Please choose the table base on guests.');
       }
       $request_date=Carbon::parse($request->res_date);
       $reservations = $table->reservations()->where('id', '!=',$reservation->id)->get();
       foreach ($reservations as $res)
       {
        if ($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
            return back()->with('warning','This table is reserved for this date.');
        }
       }
       $reservation->update($request->validated());
       return to_route('admin.reservation.index')->with('success','Reservation updated successfully');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();        
        return to_route('admin.reservation.index')->with('warning','Table deleted successfully');
    }
}

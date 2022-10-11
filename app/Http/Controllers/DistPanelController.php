<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Order;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class DistPanelController extends Controller
{
    public function index(Request $request)
    {
        if($request->department_id){
            $department = Department::findOrFail($request->department_id);
        }
        return view('pages.dist_panel.index',compact('department'));
    }

    public function technician_page()
    {
        $order = Order::
        where('technician_id',8)
        ->orderBy('index')
        ->first();
        return view('pages.dist_panel.technician',compact('order'));
    }
}

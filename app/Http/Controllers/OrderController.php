<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $areas = Area::whereHas('orders')->get();
        $creators = User::whereHas('orders_creator')->get();
        $technicians = User::whereHas('orders_technician')->get();
        $departments = Department::whereHas('orders')->get();
        $statuses = Status::all();

        $orders = Order::query()

            // For Search #########################################################

            ->when($request->name != "", function ($q) use ($request) {
                $q->whereHas('customer', function ($q2) use ($request) {
                    $q2->where('name', 'like', $request->name . '%');
                });
            })
            ->when($request->phone != "", function ($q) use ($request) {
                $q->whereHas('phone', function ($q2) use ($request) {
                    $q2->where('number', 'like', $request->phone);
                });
            })
            ->when($request->area_id != "", function ($q) use ($request) {
                $q->whereHas('address', function ($q2) use ($request) {
                    $q2->where('area_id', $request->area_id);
                });
            })
            ->when($request->block != "", function ($q) use ($request) {
                $q->whereHas('address', function ($q2) use ($request) {
                    $q2->where('block', 'like', $request->block);
                });
            })
            ->when($request->street != "", function ($q) use ($request) {
                $q->whereHas('address', function ($q2) use ($request) {
                    $q2->where('street', 'like', $request->street);
                });
            })
            ->when($request->creator_id != "", function ($q) use ($request) {
                $q->where('created_by', $request->creator_id);
            })




            ->when($request->status_id != "", function ($q) use ($request) {
                $q->whereIn('status_id', $request->status_id);
            })




            ->when($request->start_created_at != "", function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->start_created_at);
            })
            ->when($request->end_created_at != "", function ($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->end_created_at);
            })
            ->when($request->technician_id != "", function ($q) use ($request) {
                $q->where('technician_id', $request->technician_id);
            })
            ->when($request->department_id != "", function ($q) use ($request) {
                $q->where('department_id', $request->department_id);
            })
            ->when($request->has('customer_id'), function ($q) use ($request) {
                $q->where('customer_id', $request->customer_id);
            })

            //#####################################################################

            ->with(['address', 'department', 'technician', 'creator','status', 'customer', 'phone'])
            ->latest('created_at')
            ->paginate(10);

        return view('pages.orders.index', compact('orders', 'areas', 'creators', 'statuses', 'technicians', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        $customer = Customer::findOrFail($request->customer);
        return view('pages.orders.create', compact('customer'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        return view('pages.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function edit(Order $order): View
    {
        return view('pages.orders.edit', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return void
     */
    public function destroy(Order $order)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $areas = Area::all() ;
        $customers = Customer::query()

            // For Search #########################################################

            ->when($request->name != "", function ($q) use ($request) {
                $q->where('name', 'like', $request->name . '%');
            })
            ->when($request->phone != "", function ($q) use ($request) {
                $q->whereHas('phones', function ($q2) use ($request) {
                    $q2->where('number', 'like', $request->phone);
                });
            })
            ->when($request->area_id != "", function ($q) use ($request) {
                $q->whereHas('addresses', function ($q2) use ($request) {
                    $q2->where('area_id',$request->area_id);
                });
            })
            ->when($request->block != "", function ($q) use ($request) {
                $q->whereHas('addresses', function ($q2) use ($request) {
                    $q2->where('block', 'like', $request->block);
                });
            })
            ->when($request->street != "", function ($q) use ($request) {
                $q->whereHas('addresses', function ($q2) use ($request) {
                    $q2->where('street', 'like', $request->street);
                });
            })

            //#####################################################################

            ->with(['phones', 'addresses'])
            ->withCount('orders')
            ->orderByDesc('id')
            ->paginate(10);

        return view('pages.customers.index', compact('customers','areas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.customers.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return View
     */
    public function edit(Customer $customer): View
    {
        return view('pages.customers.edit', compact('customer'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        return redirect(route('customers.index'))->with('success', __('messages.deleted_successfully'));
    }
}

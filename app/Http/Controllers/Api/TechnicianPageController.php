<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class TechnicianPageController extends Controller
{
    public function getCurrenOrder()
    {
        $order = Order::query()
            ->where('technician_id', auth()->id())
            ->whereIn('status_id', [2, 3])
            ->orderBy('index')
            ->first();
        return new OrderResource($order);
    }
}

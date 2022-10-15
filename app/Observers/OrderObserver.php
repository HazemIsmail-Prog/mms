<?php

namespace App\Observers;

use App\Events\OrderCreatedEvent;
use App\Events\OrderUpdatedPerOrderEvent;
use App\Models\Order;
use App\Models\OrderStatus;
use Exception;
use Illuminate\Support\Facades\Artisan;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        if($order->status_id != 1){
            //only for db seeder to create first then change status to 2
            OrderStatus::create([
                'order_id' => $order->id,
                'status_id' => 1,
                'technician_id' => null,
                'user_id' => auth()->id() ?? 1,
            ]);
        }
        OrderStatus::create([
            'order_id'=> $order->id,
            'status_id'=> $order->status_id,
            'technician_id'=> $order->technician_id,
            'user_id'=> auth()->id() ?? 1,
        ]);
        event(new OrderCreatedEvent($order->department_id));
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        $latest_status_id = OrderStatus::where('order_id',$order->id)->orderByDesc('id')->first()->status_id;
        $latest_technician_id = OrderStatus::where('order_id',$order->id)->orderByDesc('id')->first()->technician_id;

        if($order->status_id != $latest_status_id || $order->technician_id != $latest_technician_id){
            OrderStatus::create([
                'order_id' => $order->id,
                'status_id' => $order->status_id,
                'technician_id' => $order->technician_id,
                'user_id' => auth()->id(),
            ]);
        }
        event(new OrderCreatedEvent($order->department_id));
        event(new OrderUpdatedPerOrderEvent($order->id));
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}

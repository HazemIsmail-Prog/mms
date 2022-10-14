<?php

namespace App\Http\Livewire;

use App\Events\OrderCreatedEvent;
use App\Models\Department;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class DistPanel extends Component
{
    public $orders;
    public $department_id;
    public $department;
    public $show_completed = false;
    public $show_cancelled = false;
    public $orders_date_filter = 'show_all';


    public function render()
    {
        return view('livewire.dist-panel')->layout('layouts.slot');
    }

    public function mount($id)
    {
        $this->department_id = $id;
        $this->department = Department::find($this->department_id);
        $this->date = today()->format('Y-m-d');
        $this->refresh_data();
    }

    public function updated($key)
    {
        if (in_array($key, ['date', 'show_completed', 'show_cancelled', 'orders_date_filter'])) {
            $this->refresh_data();
        }
    }

    public function refresh_data()
    {
        $this->technicians = User::query()
            ->activeTechnicinasByDepartmentId($this->department_id)
            ->get();

        $this->orders = Order::query()
            ->with(['phone', 'customer', 'address', 'status', 'creator'])
            ->where('department_id', $this->department_id)

            ->when($this->orders_date_filter == 'show_today_orders_only', function ($q) {
                $q->whereDate('created_at', $this->date);
            })
            ->when($this->orders_date_filter == 'show_previous_orders_only', function ($q) {
                $q->whereDate('created_at', '<', $this->date);
            })

            ->when($this->show_completed == false, function ($q) {
                $q->whereNotIn('status_id', [4]);
            })
            ->when($this->show_cancelled == false, function ($q) {
                $q->whereNotIn('status_id', [6]);
            })
            ->orderBy('index')
            ->get();
    }

    public function change_technician($order_id, $tech_id, $positions)
    {

        // dd($order_id, $tech_id, $positions);

        $order = Order::find($order_id);

        switch ($tech_id) {
            case 0: //unassgined box
                $order->technician_id = null;
                $order->status_id = 1;
                break;

            case 'hold': // hold box
                $order->technician_id = null;
                $order->status_id = 5;
                break;

            case 'cancel': // cancel button clicked
                $order->technician_id = null;
                $order->status_id = 6;
                break;

            default:
                $order->technician_id = $tech_id;
                $order->status_id = 2;
        }

        $order->save();


        foreach ($positions as $position) {
            $currentOrderId = $position[0];
            $currentOrderIndex = $position[1];
            $currentOrder = Order::find($currentOrderId);
            $currentOrder->update(['index' => $currentOrderIndex]);
        }

        $this->refresh_data();
        event(new OrderCreatedEvent);
    }
}

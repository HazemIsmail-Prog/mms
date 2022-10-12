<?php

namespace App\Http\Livewire;

use App\Events\OrderCreatedEvent;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class DistPanel extends Component
{

    public $date;
    public $department;
    public $technicians = [];
    public $orders = [];
    public $show_completed = false;
    public $show_cancelled = false;
    public $orders_date_filter = 'show_all';
    public $selected_order;

    public function render()
    {
        return view('livewire.dist-panel');
    }

    public function mount()
    {
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
            ->activeTechnicinasByDepartmentId($this->department->id)
            ->get();

        $this->orders = Order::query()
            ->with(['phone', 'customer', 'address','status'])
            ->where('department_id', $this->department->id)

            ->when($this->orders_date_filter == 'show_today_orders_only', function ($q) {
                $q->whereDate('created_at', $this->date);
            })
            ->when($this->orders_date_filter == 'show_previous_orders_only', function ($q) {
                $q->whereDate('created_at', '<', $this->date);
            })

            ->when($this->show_completed == false, function ($q) {
                $q->whereNotIn('status_id',[4]);
            })
            ->when($this->show_cancelled == false, function ($q) {
                $q->whereNotIn('status_id', [6]);
            })
            ->orderBy('index')
            ->get();
    }

    public function change_technician($order_id, $tech_id, $positions)
    {
        
        $tech_id = $tech_id == 0 ? null : $tech_id;
        
        $order = Order::find($order_id);
        
        $order->technician_id = $tech_id;
        
        if ($order->status_id <= 2) {
            $order->status_id = $tech_id == 0 ? 1 : 2;
        }
        
        $order->save();

        
        foreach ($positions as $position) {
            $currentOrderId = $position[0]; 
            $currentOrderIndex = $position[1]; 
            $currentOrder = Order::find($currentOrderId);
            $currentOrder->update(['index' => $tech_id . $currentOrderIndex ]);
        }

        $this->refresh_data();
        event(new OrderCreatedEvent);
    }
}

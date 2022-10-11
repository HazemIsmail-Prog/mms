<?php

namespace App\Http\Livewire;

use App\Events\OrderCreatedEvent;
use App\Models\Order;
use Livewire\Component;

class TechnicianPage extends Component
{

    public $order;

    public function render()
    {
        return view('livewire.technician-page');
    }

    public function mount()
    {
        $this->refresh_data();
    }

    public function refresh_data()
    {
        $this->order = Order::query()
            ->where('technician_id', auth()->id())
            ->whereIn('status_id',[2,3])
            ->orderBy('index')
            ->first();
    }

    public function accept_order()
    {
        $this->order->update(['status_id' => 3]);
        event(new OrderCreatedEvent);

    }

    public function complete_order()
    {
        $this->order->update([
            'status_id' => 4,
            'completed_at' => now(),
            'index' => null,
        ]);
        event(new OrderCreatedEvent);
    }
}

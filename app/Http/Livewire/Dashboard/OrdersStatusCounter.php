<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrdersStatusCounter extends Component
{
    public $dateFilter;
    public $counters;

    public function mount()
    {
        $this->dateFilter = today()->format('Y-m-d');
        $this->getCounters();
    }
    public function getCounters()
    {
        $orders = Order::query()
            ->select('id')
            ->with('latest_status')
            ->get();


        $this->counters = $orders
            ->map(
                fn ($data) => collect($data)
                    ->put('date', $data->latest_status->created_at->format('Y-m-d'))
                    ->put('status_name', $data->latest_status->status->name)
            );

        $this->counters = $this->counters->where('date', $this->dateFilter)->sortBy('status_name')->groupBy('status_name');
    }
    public function updatedDateFilter()
    {
        $this->getCounters();
    }
    public function render()
    {
        return view('livewire.dashboard.orders-status-counter');
    }
}

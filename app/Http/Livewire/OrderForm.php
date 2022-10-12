<?php

namespace App\Http\Livewire;

use App\Events\OrderCreatedEvent;
use App\Models\Department;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class OrderForm extends Component
{
    public $customer;
    public $phone_id;
    public $address_id;
    public $department_id;
    public $departments;
    public $estimated_start_date;
    public $order_description;
    public $orderNotes;
    public $dup_orders_count;
    public $action;
    public $order;
    public $statuses;

    public function render()
    {
        return view('livewire.order-form');
    }

    public function mount()
    {
        switch ($this->action) {
            case 'create':
                $this->departments = Department::where('is_service', 1)->get();
                $this->statuses = Status::limit(1)->get();
                $this->status_id = 1;
                $this->phone_id = $this->customer->phones->count() == 1 ? $this->customer->phones()->first()->id : null;
                $this->address_id = $this->customer->addresses->count() == 1 ? $this->customer->addresses()->first()->id : null;
                $this->estimated_start_date = today()->format('Y-m-d');
                break;
            case 'edit':
                $this->departments = $this->order->technician ? Department::whereId($this->order->department_id)->get() : Department::where('is_service', 1)->get();
                $this->department_id = $this->order->department_id;
                $this->customer = $this->order->customer;
                $this->phone_id = $this->order->phone->id;
                $this->address_id = $this->order->address->id;
                $this->department_id = $this->order->department_id;
                $this->estimated_start_date = $this->order->estimated_start_date;
                $this->order_description = $this->order->order_description;
                $this->orderNotes = $this->order->notes;
                break;
        }
    }

    public function rules()
    {
        return [
            'department_id' => ['required'],
            'estimated_start_date' => ['required'],
            'phone_id' => ['required'],
            'address_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'department_id.required' => __('messages.service_type_required'),
            'estimated_start_date.required' => __('messages.estimated_start_date_required'),
            'address_id.required' => __('messages.address_required'),
            'phone_id.required' => __('messages.phone_required'),
        ];
    }

    public function updated($key)
    {
        if (in_array($key, ['department_id', 'estimated_start_date', 'address_id'])) {
            $this->dup_orders_count = Order::query()
            ->where([
                'address_id' => $this->address_id,
                'department_id' => $this->department_id,
                'estimated_start_date' => $this->estimated_start_date,
            ])
            ->when($this->action == 'edit', function ($q) {
                $q->where('id', '!=', $this->order->id);
            })
            ->count();
        }
    }

    public function saveOrder()
    {
        $this->validate();
        switch ($this->action) {
            case 'create':
                $data = [
                    'customer_id' => $this->customer->id,
                    'phone_id' => $this->phone_id,
                    'address_id' => $this->address_id,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                    'department_id' => $this->department_id,
                    'estimated_start_date' => $this->estimated_start_date,
                    'notes' => $this->orderNotes,
                    'technician_id' => null,
                    'status_id' => 1,
                    'order_description' => $this->order_description,
                ];
                $this->order = Order::create($data);
                event(new OrderCreatedEvent);
                session()->flash('success', __('messages.added_successfully'));
                return redirect()->route('customers.index');
                break;

            case 'edit':
                $data = [
                    'customer_id' => $this->customer->id,
                    'phone_id' => $this->phone_id,
                    'address_id' => $this->address_id,
                    'updated_by' => auth()->id(),
                    'department_id' => $this->department_id,
                    'estimated_start_date' => $this->estimated_start_date,
                    'notes' => $this->orderNotes,
                    'order_description' => $this->order_description,
                ];
                $this->order->update($data);
                event(new OrderCreatedEvent);
                session()->flash('success', __('messages.updated_successfully'));
                return redirect()->route('orders.index');
                break;
        }
    }
}

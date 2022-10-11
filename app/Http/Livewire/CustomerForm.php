<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class CustomerForm extends Component
{
    public $action;
    public $customer;
    public $phones = [];
    public $addresses = [];
    public $name;
    public $cid;
    public $notes;
    public $areas;
    public $active = true;


    public function rules()
    {
        return [
            'name' => 'required',
            'phones.*.type' => 'required',
            // 'phones.*.number' => [
            //     'required', 'numeric', 'digits_between:8,8',
            //     'unique:phones,customer_id,' . $this->customer->id,
            // ],
            'addresses.*.area_id' => 'required',
            'addresses.*.block' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('messages.name_required'),
            'phones.*.number.unique' => __('messages.number_already_exist'),
        ];
    }

    public function render()
    {
        return view('livewire.customer-form');
    }

    // public function updated($key)
    // {
    //     if (explode('.', $key)[2] == 'number') {
    //         $this->validateOnly('phones.*.number');
    //     }
    // }

    public function mount()
    {
        $this->areas = Area::all();
        if ($this->action == 'create') {
            $this->addresses [] = [
                'id' => null,
                'customer_id' => null,
                'area_id' => '',
                'block' => null,
                'street' => null,
                'jadda' => null,
                'building' => null,
                'floor' => null,
                'apartment' => null,
                'notes' => null,
            ];

            $this->phones [] = [
                'id' => null,
                'type' => 'mobile',
                'number' => null,
            ];
        }
        if ($this->action == 'edit') {
            $this->name = $this->customer->name;
            $this->cid = $this->customer->cid;
            $this->notes = $this->customer->notes;
            $this->active = $this->customer->active;
            $this->phones = $this->customer->phones->toArray();
            $this->addresses = $this->customer->addresses->toArray();
        }
    }

    public function add_row($type)
    {
        if ($type == 'address') {
            $this->addresses [] = [
                'id' => null,
                'customer_id' => $this->customer->id ?? null,
                'area_id' => "",
                'block' => null,
                'street' => null,
                'jadda' => null,
                'building' => null,
                'floor' => null,
                'apartment' => null,
                'notes' => null,
            ];
        }
        if ($type == 'phone') {
            $this->phones [] = [
                'id' => null,
                'type' => 'mobile',
                'number' => null,
            ];
        }
    }

    public function delete_row($type, $index)
    {
        if ($type == 'address') {
            unset($this->addresses[$index]);
            $this->addresses = array_values($this->addresses);
        }
        if ($type == 'phone') {
            unset($this->phones[$index]);
            $this->phones = array_values($this->phones);
        }
    }

    public function save_with_order($with_order)
    {
        $this->validate();
        $data = [
            'name' => $this->name,
            'notes' => $this->notes,
            'cid' => $this->cid,
            'active' => $this->active ? 1 : 0,
            'created_by' => $this->customer->created_by ?? auth()->id(),
            'updated_by' => auth()->id(),
        ];
        $addresses = [];
        foreach ($this->addresses as $row) {
            $addresses[] = [
                'id' => $row['id'],
                'customer_id' => $row['customer_id'],
                'area_id' => $row['area_id'],
                'block' => $row['block'],
                'street' => $row['street'],
                'jadda' => $row['jadda'],
                'building' => $row['building'],
                'floor' => $row['floor'],
                'apartment' => $row['apartment'],
                'notes' => $row['notes'],
            ];
        }

        switch ($this->action) {
            case 'create':
                DB::beginTransaction();
                try {
                    $customer = Customer::create($data);
                    $customer->phones()->createMany($this->phones);
                    $customer->addresses()->createMany($addresses);
                    $this->customer = $customer;
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    throw ValidationException::withMessages(['error' => __('messages.something went wrong ' . '(' . $e->getMessage() . ')')]);
                }
                break;

            case 'edit' :
                DB::beginTransaction();
                try {
                    $this->customer->update($data);
                    // $this->customer->phones()->delete();
                    $this->customer->addresses()->delete();
                    foreach($this->phones as $phone){
                        $this->customer
                        ->phones()
                        ->updateOrCreate(
                            [
                                'id'=>$phone['id']
                            ],
                            [
                                'type'=>$phone['type'],
                                'number'=>$phone['number'],
                            ]
                        );
                    }
                    // $this->customer->phones()->createMany($this->phones);
                    $this->customer->addresses()->createMany($addresses);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    throw ValidationException::withMessages(['error' => __('messages.something went wrong ' . '(' . $e->getMessage() . ')')]);
                }
                break;
        }
        if ($with_order) {
            return redirect()->to('/' . config('app.locale') . '/orders/create?customer=' . $this->customer->id);

        } else {
            return redirect()->to('/' . config('app.locale') . '/customers');
        }
    }
}

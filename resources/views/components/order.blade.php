<div style=" border: 1px solid {{$order->status_color}}"
    class="order{{ in_array($order->status_id , [3,7]) ? '-non-dragable' : '' }}" 
    id="order{{$order->id}}"
    draggable='{{in_array($order->status_id , [3,7]) ? 'false' : 'true' }}'
    >
    <div class=" p-2 text-white" style="background: {{$order->status_color}}">
        <div class="d-flex justify-content-between">
            <div>{{$order->customer_name}}</div>
            <div>{{$order->phone_number}}</div>
        </div>
        <div>{{$order->address->full_address()}}</div>
    </div>
    <div class=" p-2" >
        <table class="table table-sm table-striped table-borderless mb-0">
            <tr>
                <th>@lang('messages.creator')</th>
                <td>{{$order->creator_name}}</td>
            </tr>
            <tr>
                <th>@lang('messages.order_number')</th>
                <td>{{str_pad($order->id, 8, "0", STR_PAD_LEFT)}}</td>
            </tr>
            <tr>
                <th>@lang('messages.order_description')</th>
                <td>{{$order->order_description ?? '-'}}</td>
            </tr>
            {{-- <tr>
                <th>@lang('messages.notes')</th>
                <td>{{$order->notes ?? '-'}}</td>
            </tr> --}}
        </table>
    </div>
    <div class=" d-flex justify-content-between align-items-center mb-0 p-2" style="border-top: 1px solid {{$order->status_color}}">
        <a class="btn btn-sm" href="{{route('orders.show',$order)}}" target="_blank">
            <svg style="width: 15px;height: 15px">
                <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-featured-playlist')}}"></use>
            </svg>
        </a>
        <button wire:click="change_technician({{ $order->id }}, 'cancel' , [])" class=" btn text-danger">
            @lang('messages.cancel_order')
        </button>
    </div>
</div>

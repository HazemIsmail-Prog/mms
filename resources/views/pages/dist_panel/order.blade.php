<div style="background: {{$order->status->color}}" 
    class="order{{$order->status_id == 3 ? '-non-dragable' : '' }}" 
    id="order{{$order->id}}"
    draggable='{{$order->status_id == 3 ? 'false' : 'true' }}'
    >
    <div>{{str_pad($order->id, 8, "0", STR_PAD_LEFT)}}</div>
    <div>{{$order->status->name}}</div>
    <div>{{$order->customer->name}}</div>
    <div>{{$order->phone->number}}</div>
    <div>{{$order->address->full_address()}}</div>
    <div>{{$order->order_description}}</div>
    <div>{{$order->notes}}</div>
    <a class="text-white btn btn-sm" href="{{route('orders.show',$order)}}">
        <svg style="width: 15px;height: 15px">
            <use
                xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-featured-playlist')}}"></use>
        </svg>
    </a>
</div>


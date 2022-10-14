<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">{{__('messages.order_details')}}</div>
        <div class="card-body">
            @if ($order)
                <table class="table table-striped table-borderless">
                    <tr>
                        <th>{{__('messages.order_number')}}</th>
                        <td>{{str_pad($order->id, 8, "0", STR_PAD_LEFT)}}</td>
                    </tr>
                    <tr>
                        <th>{{__('messages.customer_name')}}</th>
                        <td>{{$order->customer->name}}</td>
                    </tr>
                    <tr>
                        <th>{{__('messages.phone')}}</th>
                        <td>{{$order->phone->number}}</td>
                    </tr>
                    <tr>
                        <th>{{__('messages.address')}}</th>
                        <td>
                            <span>{{$order->address->full_address()}}</span>
                            <a class="text-dark btn btn-sm" target="_blank"
                                href="{{$order->address->maps_search()}}">
                                <svg style="width: 15px;height: 15px">
                                    <use
                                        xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-location-pin')}}"></use>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @if($order->order_description)
                        <tr>
                            <th>@lang('messages.order_description')</th>
                            <td>{{$order->order_description}}</td>
                        </tr>
                    @endif
                    @if($order->notes)
                        <tr>
                            <th>@lang('messages.notes')</th>
                            <td>{{$order->notes}}</td>
                        </tr>
                    @endif
    
                    <tr>
                        <td colspan="2" class=" text-center">
                            @if ($order->status_id != 3)
                                <button onclick="confirmAccept()" class="btn btn-warning">@lang('messages.accept')</button>
                            @else
                                <button onclick="confirmComplete()" class="btn btn-success">@lang('messages.done')</button>
                            @endif
                        </td>
                    </tr>
                </table>
    
            @else
                <div class="text-center">
                    @lang('messages.no_orders')
                </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        $(document).ready(function () {
            
            window.Echo.channel('OrderCreatedChannel')
                .listen('OrderCreatedEvent', (e) => {
                    @this.refresh_data();
                });
        });

        function confirmAccept() {
            if (confirm("Are you sure to execute this action?")) {
                @this.accept_order();
            }
        }   
        function confirmComplete() {
            if (confirm("Are you sure to execute this action?")) {
                @this.complete_order();
            }
        }   
    </script>
@endsection

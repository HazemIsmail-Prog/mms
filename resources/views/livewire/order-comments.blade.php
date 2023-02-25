<div class="card shadow">
    <div class="card-header">{{ __('messages.order_comments') }}</div>
    <div class="card-body">
        <table class="table table-borderless table-striped">
            <tbody>
                @forelse($comments as $row)
                    <tr>
                        <td class="text-center">{{ $row->comment }}</td>
                        <td nowrap class="text-center">{{ @$row->user->name }}</td>
                        <td nowrap class="text-center">
                            <div>{{ $row->created_at->format('d-m-Y') }}</div>
                            <div>{{ $row->created_at->format('H:i') }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">{{ __('messages.no_comments_found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class=" d-flex">
            <input wire:model="comment" class=" form-control" type="text">
            <button wire:click="send" class="btn btn-facebook btn-sm">{{ __('messages.send') }}</button>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        // Pusher.logToConsole = true;
        var pusher = new Pusher('eb6e9c0ae00849725f96', {
            cluster: 'mt1'
        });
        var channel = pusher.subscribe("OrderUpdatedPerOrderChannel{{ $order->id }}");
        var callback = (eventName, data) => {
                @this.refresh();

        };
        channel.bind_global(callback);









        // window.Echo.channel('OrderUpdatedPerOrderChannel{{ $order->id }}')
        //     .listen('OrderUpdatedPerOrderEvent', (e) => {
        //         @this.refresh();
        //         // location.reload();
        //     });
    </script>
@endpush

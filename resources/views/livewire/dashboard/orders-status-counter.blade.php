<div>
    <div class=" card">
        <div class="card-header">{{ __('messages.orders_statistics') }}</div>
        <div class="card-body">
            <input wire:model="dateFilter" type="date" class=" form-control form-control-sm mb-3">
            <table class=" table table-striped border">
                <thead>
                    <tr>
                        <th class=" text-center w-50">{{ __('messages.status') }}</th>
                        <th class=" text-center w-50">{{ __('messages.orders_count') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($counters as $key=>$row)
                    <tr>
                        <td class=" text-center">{{ $key }}</td>
                        <td class=" text-center">{{ $row->count() }}</td>
                    </tr>
                        
                    @empty
                        <tr>
                            <td colspan="2" class=" text-center">{{ __('messages.no_orders') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

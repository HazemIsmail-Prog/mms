@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('messages.view_order')</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card shadow">
                                    <div class="card-header">{{__('messages.order_details')}}</div>
                                    <div class="card-body">
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
                                                <td>{{$order->address->full_address()}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.service_type')</th>
                                                <td>{{$order->department->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.estimated_start_date')</th>
                                                <td>{{date('d-m-Y',strtotime($order->estimated_start_date))}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.status')</th>
                                                <td style="color: {{$order->status->color}}">{{$order->status->name}}</td>
                                            </tr>
                                            @if($order->completed_at)
                                                <tr>
                                                    <th>@lang('messages.completed_date')</th>
                                                    <td>
                                                        <div>{{date('d-m-Y',strtotime($order->completed_at))}}</div>
                                                        <div>{{date('H:i',strtotime($order->completed_at))}}</div>
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th>@lang('messages.technician')</th>
                                                <td>{{$order->technician->name ?? __('messages.unassigned') }}</td>
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
                                                <th>@lang('messages.created_at')</th>
                                                <td>
                                                    <div>{{date('d-m-Y',strtotime($order->created_at))}}</div>
                                                    <div>{{date('H:i',strtotime($order->created_at))}}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.creator')</th>
                                                <td>{{$order->creator->name}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card shadow">
                                    <div class="card-header">{{__('messages.order_progress')}}</div>
                                    <div class="card-body">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                            <tr>
                                                <th class="text-center">{{__('messages.status')}}</th>
                                                <th class="text-center">{{__('messages.technician')}}</th>
                                                <th class="text-center">{{__('messages.date')}}</th>
                                                <th class="text-center">{{__('messages.time')}}</th>
                                                <th class="text-center">{{__('messages.user')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($order->statuses as $row)
                                                <tr>
                                                    <td style="color: {{$row->status->color}}" class="text-center">{{$row->status->name}}</td>
                                                    <td class="text-center">{{@$row->technician->name}}</td>
                                                    <td class="text-center">{{$row->created_at->format('d-m-Y')}}</td>
                                                    <td class="text-center">{{$row->created_at->format('H:i')}}</td>
                                                    <td class="text-center">{{$row->creator->name}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4"
                                                        class="text-center">{{__('messages.no_records_found')}}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- <div class="col-md-4">
                                <div class="card shadow">
                                    <div class="card-header">{{__('messages.order_comments')}}</div>
                                    <div class="card-body">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                            <tr>
                                                <th class="text-center">{{__('messages.user')}}</th>
                                                <th>{{__('messages.comment')}}</th>
                                                <th class="text-center">{{__('messages.date')}}</th>
                                                <th class="text-center">{{__('messages.time')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($order->actions->reverse() as $row)
                                                <tr>
                                                    <td class="text-center">{{$row->user->name}}</td>
                                                    <td>{{$row->comment}}</td>
                                                    <td nowrap
                                                        class="text-center">{{date('d-m-Y',strtotime($row->created_at))}}</td>
                                                    <td nowrap
                                                        class="text-center">{{date('H:i',strtotime($row->created_at))}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4"
                                                        class="text-center">{{__('messages.no_records_found')}}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        window.Echo.channel('OrderUpdatedPerOrderChannel{{ $order->id }}')
            .listen('OrderUpdatedPerOrderEvent', (e) => {
            location.reload();
            });
    </script>
@endsection

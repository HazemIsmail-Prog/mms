@if($selected_order)
    <div data-instance="{{ $selected_order }}">

        <div wire:ignore.self class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card shadow">
                                    <div class="card-header">{{__('messages.order_details')}}</div>
                                    <div class="card-body">
                                        <table class="table table-striped table-borderless">
                                            <tr>
                                                <th>{{__('messages.customer_name')}}</th>
                                                <td>{{$selected_order->customer->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('messages.phone')}}</th>
                                                <td>{{$selected_order->phone->number}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('messages.address')}}</th>
                                                <td>{{$selected_order->address->full_address()}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.service_type')</th>
                                                <td>{{$selected_order->department->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.estimated_start_date')</th>
                                                <td>{{date('d-m-Y',strtotime($selected_order->estimated_start_date))}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.status')</th>
                                                <td>{{$latest_status->name}}</td>
                                            </tr>
                                            @if($latest_status->name_en == 'Completed')
                                                <tr>
                                                    <th>@lang('messages.completed_date')</th>
                                                    <td>
                                                        <div>{{date('d-m-Y',strtotime($latest_status->pivot->created_at))}}</div>
                                                        <div>{{date('H:i',strtotime($latest_status->pivot->created_at))}}</div>
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th>@lang('messages.technician')</th>
                                                <td>{{$selected_order->technician->name ?? __('messages.unassigned') }}</td>
                                            </tr>
                                            @if($selected_order->order_description)
                                                <tr>
                                                    <th>@lang('messages.order_description')</th>
                                                    <td>{{$selected_order->order_description}}</td>
                                                </tr>
                                            @endif
                                            @if($selected_order->notes)
                                                <tr>
                                                    <th>@lang('messages.notes')</th>
                                                    <td>{{$selected_order->notes}}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th>@lang('messages.created_at')</th>
                                                <td>
                                                    <div>{{date('d-m-Y',strtotime($selected_order->created_at))}}</div>
                                                    <div>{{date('H:i',strtotime($selected_order->created_at))}}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.creator')</th>
                                                <td>{{$selected_order->creator->name}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                @if(!in_array($latest_status->id,[1]))
                                    <div class="card shadow">
                                        <div class="card-header">{{__('messages.change_status')}}</div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <div class="form-group w-100">
                                                        <label for="status_id">{{__('messages.status')}}</label>
                                                        <select wire.model="status_id" class="form-control">
                                                            <option selected value="">---</option>
                                                            @foreach(\App\Models\Status::whereNotIn('id',[1,2])->get() as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group w-100">
                                                        <label for="reason">{{__('messages.reason')}}</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <button class="btn btn-success">{{__('messages.save')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow">
                                    <div class="card-header">{{__('messages.order_progress')}}</div>
                                    <div class="card-body">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                            <tr>
                                                <th class="text-center">{{__('messages.status')}}</th>
                                                <th class="text-center">{{__('messages.comment')}}</th>
                                                <th class="text-center">{{__('messages.date')}}</th>
                                                <th class="text-center">{{__('messages.time')}}</th>
                                                <th class="text-center">{{__('messages.user')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($selected_order->status->reverse() as $row)
                                                <tr>
                                                    <td class="text-center">{{$row->name}}</td>
                                                    <td class="text-center">{{$row->pivot->comment}}</td>
                                                    <td class="text-center">{{date('d-m-Y',strtotime($row->pivot->created_at))}}</td>
                                                    <td class="text-center">{{date('H:i',strtotime($row->pivot->created_at))}}</td>
                                                    <td class="text-center">{{\App\Models\User::find($row->pivot->user_id)->name}}</td>
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
                                                <td colspan="4">
                                                    <div class="d-flex">

                                                        <input wire:model.lazy="comment" type="text"
                                                               class="form-control w-100">
                                                        <button wire:click="send_comment"
                                                                class="btn btn-success">{{__('messages.send')}}</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">{{__('messages.sender')}}</th>
                                                <th>{{__('messages.comment')}}</th>
                                                <th class="text-center">{{__('messages.date')}}</th>
                                                <th class="text-center">{{__('messages.time')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($order_actions as $row)
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
@endif

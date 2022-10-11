{{--<div {{$polling ? 'wire:poll.5000ms' : ''}} >--}}
<div>
    @if(auth()->user()->title_id !=11 && auth()->user()->title_id !=10)
        <div class="row">
            <div class="form-group col-md-3">
                <label for="department_id">@lang('messages.department')</label>
                <select wire:model="department_id"
                        class="form-control @error('department') is-invalid @enderror"
                        id="department">
                    <option value="">---</option>
                    @foreach($departments as $department)
                        <option
                            value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
                @error('department_id')<span
                    class="small text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group col-md-3">
                <label for="date">@lang('messages.date')</label>
                <input type="date" wire:model="date" class="form-control @error('date') is-invalid @enderror" id="date">
                @error('date')<span
                    class="small text-danger">{{ $message }}</span>@enderror
            </div>
            @if($department_id)
                <div class="form-group col-md-2 align-self-end">
                    <div class="form-check">
                        <input wire:model="show_completed" class="form-check-input" type="checkbox" name="active"
                               {{old('active') ? 'checked' : ''}} id="show_completed">
                        <label class="form-check-label" for="show_completed">
                            @lang('messages.show_completed')
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2 align-self-end">
                    <div class="form-check">
                        <input wire:model="show_cancelled" class="form-check-input" type="checkbox" name="active"
                               {{old('active') ? 'checked' : ''}} id="show_cancelled">
                        <label class="form-check-label" for="show_cancelled">
                            @lang('messages.show_cancelled')
                        </label>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <div class="d-flex align-items-start justify-content-center" style="column-gap: 10px;">
        @if($department_id)
            @if(auth()->user()->title_id !=11)
                <div class="card" style="min-width: 266px;">
                    <div class="card-header text-center">{{__('messages.unassigned')}}</div>
                    <div class="p-2 card-body box" style="min-height: 100px">
                        @forelse($orders->whereNull('technician_id') as $order)
                            <div class="text-white mb-2 {{($order->latest_status()->id == 6 ||$order->latest_status()->id == 8)  ? '' : 'order'}}" id="order-{{$order->id}}"
                                 style="width: 250px;border-radius: 5px;overflow: hidden; background: {{$order->latest_status()->color}}">
                                <div class="p-2">
                                    <div>{{$order->customer->name}}</div>
                                    <div>{{$order->phone->number}}</div>
                                    <div>{{$order->address->full_address()}}</div>
                                    <div>{{$order->order_description}}</div>
                                    <div>{{$order->notes}}</div>
                                </div>
{{--                                @if($order->actions->count()>0)--}}
{{--                                    <div class="p-2 border-top">--}}
{{--                                        @foreach($order->actions as $action)--}}
{{--                                            <div style="font-size: .6rem;">{{$action->user->name}}--}}
{{--                                                : {{$action->comment}}</div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                @endif--}}

                                <div class="bg-dark d-flex justify-content-center border-top">
                                    <a class="text-decoration-none text-white py-2 w-100 text-center border-left"
                                       href="" onclick="event.preventDefault(); add_comment({{$order->id}});">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-comment-square')}}"></use>
                                        </svg>
                                    </a>

                                    <a class="text-decoration-none text-white py-2 w-100 text-center"
                                       target="_blank"
                                       href="https://www.google.com/maps/place/{{$order->address->area->name . '+قطعة+' . $order->address->block . ($order->address->street ? '+شارع+' . $order->address->street:'') . ($order->address->jadda ? '+جادة+' . $order->address->jadda:'') . ($order->address->building ? '+مبنى+' . $order->address->building:'')}}">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-location-pin')}}"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="d-flex justify-content-center align-items-center">

                                {{__('messages.no_orders')}}
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        @endif
        <div class="d-flex align-items-start justify-content-start" style="column-gap: 10px;overflow: auto">
            @foreach($technicians as $technician)
                <div class="card" style="min-width: 266px">
                    @if(auth()->user()->title_id != 11)
                        <div class="card-header text-center">{{$technician->name}}</div>
                    @endif
                    <div class="p-2 card-body box" id="{{$technician->id}}" style="min-height: 100px">
                        @forelse($orders->where('technician_id',$technician->id) as $order)
                            <div class="text-white mb-2 {{auth()->user()->title_id != 11 ? 'order' : ''}}"
                                 id="order-{{$order->id}}"
                                 style="width: 250px;border-radius: 5px;overflow: hidden;background: {{$order->latest_status()->color}}">
                                <div class="p-2">
                                    <div>{{$order->customer->name}}</div>
                                    <div>{{$order->phone->number}}</div>
                                    <div>{{$order->address->full_address()}}</div>
                                    <div>{{$order->order_description}}</div>
                                    <div>{{$order->notes}}</div>
                                </div>
{{--                                @if($order->actions->count()>0)--}}
{{--                                    <div class="p-2 border-top">--}}
{{--                                        @foreach($order->actions as $action)--}}
{{--                                            <div style="font-size: .6rem;">{{$action->user->name}}--}}
{{--                                                : {{$action->comment}}</div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                @endif--}}

                                <div class="bg-dark d-flex justify-content-center border border-top">
                                    <a class="text-decoration-none text-white py-2 w-100 text-center border-left"
                                       href="" onclick="event.preventDefault(); add_comment({{$order->id}});">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-comment-square')}}"></use>
                                        </svg>
                                    </a>

                                    <a class="text-decoration-none text-white py-2 w-100 text-center"
                                       target="_blank"
                                       href="https://www.google.com/maps/place/{{$order->address->area->name . '+قطعة+' . $order->address->block . ($order->address->street ? '+شارع+' . $order->address->street:'') . ($order->address->jadda ? '+جادة+' . $order->address->jadda:'') . ($order->address->building ? '+مبنى+' . $order->address->building:'')}}">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-location-pin')}}"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="d-flex justify-content-center align-items-center">

                                {{__('messages.no_orders')}}
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{asset('vendors\draganddrop\jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('vendors\draganddrop\draganddrop.js')}}" type='text/javascript'></script>

    <script>
        window.addEventListener('data-updated', event => {
            loadData();
        });

        var refreshId = setInterval(function () {
            if (!$('.box').hasClass('hovering')) {
            @this.refresh_data();
            }
        }, 5000);

        function loadData() {

            //draggable
            $('.order').draggable({
                revert: false, //if true click event will be disabled
                placeholder: false, //if true click event will be disabled
                scroll: true,
                droptarget: '.box',
                drop: function (evt, droptarget) {
                    $(this).appendTo(droptarget);
                    var tech_id = $(droptarget).attr('id');
                    var order_id = $(this).attr('id');
                @this.change_technician(order_id, tech_id);
                }
            });
        }

        function add_comment(id) {
            var comment = window.prompt('{{__('messages.enter_comment')}}');
            if (comment == null || comment == "") {
                //
            } else {
            @this.add_comment(id, comment);
            }
        }
    </script>
@endsection

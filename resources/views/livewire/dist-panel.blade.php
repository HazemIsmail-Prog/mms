<div>
    <!-- Modal -->
{{-- @include('pages.dist_panel.order_modal') --}}
<!-- Modal -->

    <div class="d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap">

        {{-- Date Filter --}}
        <div class="form-group w-100">
            <label for="date">{{__('messages.date')}}</label>
            <input type="date" wire:model="date" class="form-control @error('date') is-invalid @enderror" id="date">
            @error('date')<span
                class="small text-danger">{{ $message }}</span>@enderror
        </div>

        <div class="w-100 align-self-end form-group">
            {{-- Show Completed Orders Filter --}}
            <div class="form-check">
                <input wire:model="show_completed" class="form-check-input" type="checkbox" name="active"
                       id="show_completed">
                <label class="form-check-label" for="show_completed">{{__('messages.show_completed')}}</label>
            </div>

            {{-- Show Cancelled Orders Filter --}}
            <div class="form-check">
                <input wire:model="show_cancelled" class="form-check-input" type="checkbox" name="active"
                       id="show_cancelled">
                <label class="form-check-label" for="show_cancelled">{{__('messages.show_cancelled')}}</label>
            </div>
        </div>

        <div class="w-100 align-self-end form-group">

            {{-- Show All Orders Filter --}}
            <div class="custom-control custom-radio">
                <input type="radio" id="show_all" wire:model="orders_date_filter" value="show_all"
                       name="orders_date_filter" class="custom-control-input">
                <label class="custom-control-label" for="show_all">
                    {{__('messages.show_all')}}
                </label>
            </div>

            {{-- Show Today's Orders Filter --}}
            <div class="custom-control custom-radio">
                <input type="radio" id="show_today_orders_only" wire:model="orders_date_filter"
                       value="show_today_orders_only" name="orders_date_filter" class="custom-control-input">
                <label class="custom-control-label" for="show_today_orders_only">
                    {{__('messages.show_today_orders_only')}}
                </label>
            </div>

            {{-- Show Previous Orders Filter --}}
            <div class="custom-control custom-radio">
                <input type="radio" id="show_previous_orders_only" wire:model="orders_date_filter"
                       value="show_previous_orders_only" name="orders_date_filter" class="custom-control-input">
                <label class="custom-control-label" for="show_previous_orders_only">
                    {{__('messages.show_previous_orders_only')}}
                </label>
            </div>
        </div>
    </div>

    {{-- Unassigned Orders Card --}}
    <div class="card">
        <div class="card-header text-center">{{__('messages.unassigned')}}</div>
        <div class="card-body p-0">
            <div id="0" class="box unassigned_box">
                @foreach($orders->whereNull('technician_id') as $order)
                    @include('pages.dist_panel.order')
                @endforeach
            </div>
        </div>
    </div>

    {{-- Technicians --}}
    <div class="d-flex align-items-start justify-content-start tech_list"
         style="column-gap: 10px;overflow: auto">
        @foreach($technicians as $technician)

            {{-- Technician Card --}}
            <div class="card" style="min-width: 266px">
                <div class="card-header text-center d-flex justify-content-between mb-0">
                    <div>{{$technician->name}} {{ $technician->id }}</div>
                    {{-- @if($technician->completed_orders > 0)
                        <a class="bg-success px-2 pt-1 rounded-circle text-white"
                           href="">{{$technician->completed_orders}}</a>
                    @endif --}}
                </div>
                <div class="card-body p-0">
                    <div id="{{$technician->id}}" class="box tech_box">
                        @foreach($orders->where('technician_id',$technician->id) as $order)
                            @include('pages.dist_panel.order')
                        @endforeach
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>

@section('styles')
    <style>

        /*.order {*/
        /*    width: 250px;*/
        /*    min-width: 250px;*/
        /*}*/

        .tech_box > .order-non-dragable,
        .tech_box > .order {
            cursor: pointer;
            margin-bottom: 5px;
            border-radius: 5px;
            padding: 10px;
            color: white;
            font-size: .75rem;
            text-align: center;
        }
        .unassigned_box > .order {
            width: 244px;
            min-width: 244px;
            cursor: pointer;
            margin: 0 3px;
            border-radius: 5px;
            padding: 10px;
            color: white;
            font-size: .75rem;
        }

        .unassigned_box {
            min-height: 100px;
            overflow-y: hidden;
            overflow-x: scroll;
            padding: 10px;
            display: flex;
            flex-direction: row;
            align-items: start;
        }

        .tech_box {
            min-height: 250px;
            padding: 10px;
        }

        /*.tech_list::-webkit-scrollbar,*/
        /*.tech_box::-webkit-scrollbar {*/
        /*    display: none;*/
        /*}*/

        .modal-dialog {
            max-width: 95%;
        }

        .modal.fade.show {
            padding-left: 0;
        }

    </style>
@endsection

@section('scripts')
    <script src="{{asset('vendors/sortable/Sortable.js')}}"></script>
    <script src="{{asset('vendors/dragula/dragula.js')}}"></script>
    <link rel="stylesheet" href="{{asset('vendors/dragula/dragula.css')}}">    
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        $(document).ready(function () {

            loadDataFromDragulaJs();

            window.Echo.channel('OrderCreatedChannel')
                .listen('OrderCreatedEvent', (e) => {
                @this.refresh_data();
                });

            function loadDataFromDragulaJs() {
                const boxNodes = document.querySelectorAll('.box');

                const draggableBoxes = [].slice.call(boxNodes);

                dragula(draggableBoxes, {
                    ignoreInputTextSelection: false
                })
                .on('drop', function (order,boxTo,boxFrom) {
                    var order_id = order.id;
                    var tech_id = boxTo.id;
                    var positions = [];
                    $('#' + boxTo.id).children().each(function (index) {
                        positions.push([$(this).attr('id'),index]);
                    });
                    @this.change_technician(order_id, tech_id, positions);

                    // console.log(order.id,boxTo.id,positions);
                });
            }
            // function loadDataFromSortableJs() {
            //     var el = $('.box');
            //     $(el).each(function (i, e) {
            //         var sortable = Sortable.create(e, {
            //             sort: true,
            //             animation: 150,
            //             // multiDrag: true,
            //             group: 'box', // set both lists to same group
            //             draggable: ".order",  // Specifies which items inside the element should be draggable
            //             onEnd: function (/**Event*/evt) {
            //                 var order_id = evt.item.id;
            //                 var tech_id = evt.to.id;
            //                 var positions = [];
            //                 $('#' + evt.to.id).children().each(function (index) {
            //                     positions.push([$(this).attr('id'),index]);
            //                 });
            //                 @this.change_technician(order_id, tech_id, positions);
            //             },
            //         });
            //     });
            // }
        });
    </script>
@endsection


@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>{{__('messages.orders')}}</div>
                        <div>{{__('messages.results_number')}} = {{$orders->total()}}</div>
                    </div>

                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                        @endif
                        <div>
                            <button class="btn btn-sm btn-facebook mb-2" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                <svg style="width: 15px;height: 15px">
                                    <use
                                        xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-search')}}"></use>
                                </svg>

                            </button>
                        </div>
                        <div class="collapse" id="collapseExample">

                            <div class="card shadow">
                                <div class="card-body">
                                    <form action="{{route('orders.index')}}">
                                        <div class="d-flex flex-wrap flex-xxl-nowrap">
                                            <div class="form-group w-100">
                                                <label for="name">{{__('messages.customer_name')}}</label>
                                                <input autocomplete="off" list="autocompleteOff" type="text" name="name"
                                                       id="name"
                                                       class="form-control" value="{{request('name')}}">
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="phone">{{__('messages.customer_phone')}}</label>
                                                <input autocomplete="off" list="autocompleteOff" type="number"
                                                       name="phone"
                                                       id="phone"
                                                       class="form-control" value="{{request('phone')}}">
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="area_id">{{__('messages.area')}}</label>
                                                <select class="form-control" name="area_id" id="area_id">
                                                    <option disabled selected value="">---</option>
                                                    @foreach($areas->sortBy->name as $area)
                                                        <option
                                                            {{request('area_id') == $area->id ? 'selected' : ''}} value="{{$area->id}}">{{$area->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="block">{{__('messages.block')}}</label>
                                                <input autocomplete="off" list="autocompleteOff" type="text"
                                                       name="block" id="block"
                                                       class="form-control" value="{{request('block')}}">
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="street">{{__('messages.street')}}</label>
                                                <input autocomplete="off" list="autocompleteOff" type="text"
                                                       name="street"
                                                       id="street"
                                                       class="form-control" value="{{request('street')}}">
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap flex-xxl-nowrap">

                                            <div class="form-group w-100">
                                                <label for="creator_id">{{__('messages.creator')}}</label>
                                                <select class="form-control" name="creator_id" id="creator_id">
                                                    <option disabled selected value="">---</option>
                                                    @foreach($creators as $creator)
                                                        <option
                                                            {{request('creator_id') == $creator->id ? 'selected' : ''}} value="{{$creator->id}}">{{$creator->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group w-100">
                                                <label for="status_id">{{__('messages.status')}}</label>
                                                <select class="form-control select2" multiple="multiple"
                                                        name="status_id[]"
                                                        id="status_id" style="width: 100%">
                                                    <option disabled value="">---</option>
                                                    @foreach($statuses as $status)
                                                        <option
                                                            {{request('status_id') ? in_array($status->id,request('status_id')) ? 'selected' : '' : ''}} value="{{$status->id}}">{{$status->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="technician_id">{{__('messages.technician')}}</label>
                                                <select class="form-control" name="technician_id" id="technician_id">
                                                    <option disabled selected value="">---</option>
                                                    @foreach($technicians as $technician)
                                                        <option
                                                            {{request('technician_id') == $technician->id ? 'selected' : ''}} value="{{$technician->id}}">{{$technician->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group w-100">
                                                <label for="department_id">{{__('messages.department')}}</label>
                                                <select class="form-control" name="department_id" id="department_id">
                                                    <option disabled selected value="">---</option>
                                                    @foreach($departments as $department)
                                                        <option
                                                            {{request('department_id') == $department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="start_created_at">{{__('messages.created_at')}}</label>
                                                <input autocomplete="off" list="autocompleteOff" type="date"
                                                       name="start_created_at"
                                                       id="start_created_at"
                                                       class="form-control" value="{{request('start_created_at')}}">
                                                <input autocomplete="off" list="autocompleteOff" type="date"
                                                       name="end_created_at"
                                                       id="end_created_at"
                                                       class="form-control" value="{{request('end_created_at')}}">
                                            </div>

                                            <div class="form-group w-100">
                                                <label for="start_created_at">{{__('messages.completed_at')}}</label>
                                                <input autocomplete="off" list="autocompleteOff" type="date"
                                                       name="start_completed_at" id="start_completed_at"
                                                       class="form-control" value="{{request('start_completed_at')}}">
                                                <input autocomplete="off" list="autocompleteOff" type="date"
                                                       name="end_completed_at"
                                                       id="end_completed_at"
                                                       class="form-control" value="{{request('end_completed_at')}}">
                                            </div>


                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-sm btn-facebook">{{__('messages.search')}}</button>
                                            @if(request()->input())
                                                <a href="{{route('orders.index')}}"
                                                   class="btn btn-sm btn-danger">{{__('messages.cancel')}}</a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive shadow">

                            <table class="table table-hover table-outline mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center">@lang('messages.created_at')</th>
                                    <th class="text-center">@lang('messages.estimated_start_date')</th>
                                    <th class="text-center">@lang('messages.status')</th>
                                    <th class="text-center">@lang('messages.department')</th>
                                    <th class="text-center">@lang('messages.technician')</th>
                                    <th class="text-center">@lang('messages.completed_date')</th>
                                    <th class="text-center">@lang('messages.customer')</th>
                                    <th class="text-center">@lang('messages.actions')</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($orders as $order)
                                    <tr>
                                        <td class="text-center" nowrap>
                                            <div
                                                class="small badge badge-pill badge-dark">{{$order->creator->name}}</div>
                                            <div>{{date('d-m-Y',strtotime($order->created_at))}}</div>
                                            <div class="small">{{date('H:i',strtotime($order->created_at))}}</div>
                                        </td>
                                        <td class="text-center"
                                            nowrap>{{date('d-m-Y',strtotime($order->estimated_start_date))}}</td>
                                        <td style="color: {{$order->status->color}}" class="text-center"
                                            nowrap>{{$order->status->name}}</td>
                                        <td class="text-center" nowrap>{{$order->department->name}}</td>
                                        <td class="text-center"
                                            nowrap>{{$order->technician->name ?? __('messages.unassigned')}}</td>
                                        <td class="text-center" nowrap>
                                            @if ($order->completed_at)
                                                <div>{{date('d-m-Y',strtotime($order->completed_at))}}</div>
                                                <div class="small">{{date('H:i',strtotime($order->completed_at))}}</div>
                                            @endif
                                        </td>
                                        <td nowrap>
                                            <div>{{$order->customer->name}}</div>
                                            <div>{{$order->phone->number}}</div>
                                            <a class="text-decoration-none text-dark" target="_blank"
                                               href="{{$order->address->maps_search()}}">
                                                <svg style="width: 15px;height: 15px">
                                                    <use
                                                        xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-location-pin')}}"></use>
                                                </svg>
                                            </a>
                                            <span>{{$order->address->full_address()}}</span>
                                        </td>

                                        <td class="text-center" nowrap>
                                            @can('orders_show')
                                                <a class="text-info btn btn-sm" href="{{route('orders.show',$order)}}">
                                                    <svg style="width: 15px;height: 15px">
                                                        <use
                                                            xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-featured-playlist')}}"></use>
                                                    </svg>
                                                </a>
                                            @endcan

                                            @can('orders_edit')
                                                <a class="text-info btn btn-sm" href="{{route('orders.edit',$order)}}">
                                                    <svg style="width: 15px;height: 15px">
                                                        <use
                                                            xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-pencil')}}"></use>
                                                    </svg>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="8">{{__('messages.no_orders')}}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .select2-selection__rendered {
            line-height: 23px !important;
        }


        .select2-container--default .select2-selection--multiple {
            background-color: transparent;

            border: 1px solid #d8dbe0;
            border-radius: 4px;
            cursor: text;
            padding-bottom: 10px;
            padding-right: 5px;
            position: relative;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "---",
                tags: true,
                dropdownAutoWidth: true,
                // allowClear: true,
                tokenSeparators: ['/', ','],
                textAlign: 'center',
            })
        })
    </script>
@endsection

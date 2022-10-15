@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>@lang('messages.customers')</div>
                        @can('customers_create')
                            <div><a class="btn btn-info"
                                    href="{{route('customers.form')}}">@lang('messages.add_customer')</a></div>
                        @endcan
                    </div>

                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                        @endif

                        <div class="table-responsive shadow">

                            <table class="table table-hover table-outline mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>@lang('messages.name')</th>
                                    <th class="text-center">{{__('messages.tel')}}</th>
                                    <th class="text-center">{{__('messages.address')}}</th>
                                    <th class="text-center">{{__('messages.orders')}}</th>
                                    <th class="text-center">{{__('messages.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-light">
                                    <form action="{{route('customers.index')}}">
                                        <td><input autocomplete="off" list="autocompleteOff" type="text" name="name"
                                                   class="form-control" value="{{request('name')}}"></td>
                                        <td><input autocomplete="off" list="autocompleteOff" type="number" name="phone"
                                                   class="form-control" value="{{request('phone')}}"></td>
                                        <td class="custom-control-inline">
                                            <select class="form-control" name="area_id" id="area_id">
                                                <option disabled selected value="">{{__('messages.area')}}</option>
                                                @foreach($areas->sortBy->name as $area)
                                                    <option
                                                        {{request('area_id') == $area->id ? 'selected' : ''}} value="{{$area->id}}">{{$area->name}}</option>
                                                @endforeach
                                            </select>
                                            <input autocomplete="off" list="autocompleteOff" type="text" name="block"
                                                   class="form-control mx-1" value="{{request('block')}}"
                                                   placeholder="{{__('messages.block')}}">
                                            <input autocomplete="off" list="autocompleteOff" type="text" name="street"
                                                   class="form-control" value="{{request('street')}}"
                                                   placeholder="{{__('messages.street')}}">
                                        </td>
                                        <td></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-facebook">{{__('messages.search')}}</button>
                                            @if(request()->input())
                                                <a href="{{route('customers.index')}}"
                                                   class="btn btn-sm btn-danger">{{__('messages.cancel')}}</a>
                                            @endif
                                        </td>
                                    </form>
                                </tr>

                                @forelse($customers as $customer)
                                    <tr>
                                        <td nowrap>{{$customer->name}}</td>
                                        <td class="text-center">
                                            @foreach($customer->phones as $phone)
                                                <div>{{$phone->number}}</div>
                                            @endforeach
                                        </td>
                                        <td nowrap>
                                            @foreach($customer->addresses as $address)
                                                <div>
                                                    <a class="text-dark btn btn-sm" target="_blank"
                                                       href="{{$address->maps_search()}}">
                                                        <svg style="width: 15px;height: 15px">
                                                            <use
                                                                xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-location-pin')}}"></use>
                                                        </svg>
                                                    </a>
                                                    <span>{{$address->full_address()}}</span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @if($customer->orders_count > 0)
                                                @can('orders_menu')
                                                    <a href="{{route('orders.index',['customer_id'=>$customer->id])}}"
                                                       class="btn btn-warning btn-sm text-white font-weight-bolder">
                                                        {{$customer->orders_count}}
                                                    </a>
                                                @endcan
                                            @endif
                                        </td>
                                        <td class="text-center" nowrap>
                                            @can('orders_create')
                                                <a class="text-success btn btn-sm"
                                                   href="{{route('orders.form',$customer->id)}}">
                                                    <svg style="width: 15px;height: 15px">
                                                        <use
                                                            xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-plus')}}"></use>
                                                    </svg>
                                                </a>
                                                {{-- <a class="text-success btn btn-sm"
                                                   href="{{route('orders.create',['customer' => $customer->id])}}">
                                                    <svg style="width: 15px;height: 15px">
                                                        <use
                                                            xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-plus')}}"></use>
                                                    </svg>
                                                </a> --}}
                                            @endcan
                                            @can('customers_edit')
                                                <a class="text-info btn btn-sm"
                                                   href="{{route('customers.form',$customer->id)}}">
                                                    <svg style="width: 15px;height: 15px">
                                                        <use
                                                            xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-pencil')}}"></use>
                                                    </svg>
                                                </a>
                                            @endcan
                                            @can('customers_delete')
                                                <form class="d-inline" action="{{route('customers.destroy',$customer)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger btn btn-sm"
                                                            onclick="return confirm('{{__('messages.delete_r_u_sure')}}')">
                                                        <svg style="width: 15px;height: 15px">
                                                            <use
                                                                xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-trash')}}"></use>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">No results</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        {{$customers->appends(request()->input())->links()}}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

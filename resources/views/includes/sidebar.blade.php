<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand flex-column">
{{--        <div>{{auth()->user()->name}}</div>--}}
{{--        <div style="font-size: 0.6rem">{{auth()->user()->title->name}}</div>--}}
    </div>
    <ul class="c-sidebar-nav">

        @can('dashboard_menu')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('home')}}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
                    </svg>
                    @lang('messages.dashboard')
                    <span class="badge badge-pill badge-info">@lang('messages.new')</span>
                </a>
            </li>
        @endcan

        @if (auth()->user()->role_id == 1)
            
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('artisan.index')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                </svg>
                @lang('messages.artisan_commands')
            </a>
        </li>
        {{-- <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('migrate')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                </svg>
                @lang('messages.migrate_fresh_seed')
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('clear')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                </svg>
                @lang('messages.clear_cache')
            </a>
        </li> --}}
        @endif

        @can('settings_menu')
            <li class="c-sidebar-nav-title text-info">
                @lang('messages.settings')
            </li>
            @can('departments_menu')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('departments.index')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg>
                        @lang('messages.departments')
                    </a>
                </li>
            @endcan
            @can('titles_menu')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('titles.index')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg>
                        @lang('messages.titles')
                    </a>
                </li>
            @endcan
            @can('users_menu')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('users.index')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg>
                        @lang('messages.users')
                    </a>
                </li>
            @endcan
            @can('roles_menu')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('roles.index')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg>
                        @lang('messages.roles')
                    </a>
                </li>
            @endcan
            @can('statuses_menu')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('statuses.index')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg>
                        @lang('messages.statuses')
                    </a>
                </li>
            @endcan
        @endcan


        @can('operations_menu')
            <li class="c-sidebar-nav-title text-info">
                @lang('messages.operations')
            </li>
            @can('customers_menu')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('customers.index')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg>
                        @lang('messages.customers')
                    </a>
                </li>
            @endcan
            @can('orders_menu')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('orders.index')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg>
                        @lang('messages.orders')
                    </a>
                </li>
            @endcan
        @endcan


        @can('dispatching_menu')
            <li class="c-sidebar-nav-title text-info">
                @lang('messages.dispatching')
            </li>
            @foreach(auth()->user()->departments()->where('is_service',true)->get() as $department)
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link"
                       href="{{route('dist_panel.index',$department->id)}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg>
                        {{$department->name}}
                    </a>
                </li>
            @endforeach
        @endcan

        @can('reports_menu')
            <li class="c-sidebar-nav-title text-info">
                @lang('messages.reports')
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-star')}}"></use>
                    </svg>
                    @lang('messages.reports')
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="icons/coreui-icons-free.html">
                            @lang('messages.report1')
                            <span class="badge badge-pill badge-success">@lang('messages.new')</span>
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="icons/coreui-icons-brand.html">
                            @lang('messages.report2')
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="icons/coreui-icons-flag.html">
                            @lang('messages.report3')
                        </a>
                    </li>
                </ul>
            </li>
        @endcan


    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>

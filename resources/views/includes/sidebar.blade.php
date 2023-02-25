<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand flex-column">
       <div>{{auth()->user()->name}}</div>
       <div style="font-size: 0.6rem">{{auth()->user()->title->name}}</div>
    </div>

    @php
        $services = [];
        foreach (auth()->user()->departments()->where('is_service',true)->get() as $service) {
            $services [] = [
                'permission_name'   => 'dispatching_menu',
                'type'              => 'nav_menu_item',
                'route'             => route('dist_panel.index',$service->id ),
                'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-truck'),
                'display_name'      => $service->name,
            ];
        }

        $nav_menu_items = [
            [
                'permission_name'   => 'dashboard_menu',
                'type'              => 'nav_menu_item',
                'route'             => route('home'),
                'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer'),
                'display_name'      => __('messages.dashboard'),
            ],
            [
                'permission_name'   => 'settings_menu',
                'type'              => 'menu_header',
                'display_name'      => __('messages.settings'),
                'childs'            => 
                [
                    [
                        'permission_name'   => 'roles_menu',
                        'type'              => 'nav_menu_item',
                        'route'             => route('roles.index'),
                        'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-lock-locked'),
                        'display_name'      => __('messages.roles'),
                    ],
                    [
                        'permission_name'   => 'departments_menu',
                        'type'              => 'nav_menu_item',
                        'route'             => route('departments.index'),
                        'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-sitemap'),
                        'display_name'      => __('messages.departments'),
                    ],
                    [
                        'permission_name'   => 'titles_menu',
                        'type'              => 'nav_menu_item',
                        'route'             => route('titles.index'),
                        'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-fork'),
                        'display_name'      => __('messages.titles'),
                    ],
                    [
                        'permission_name'   => 'users_menu',
                        'type'              => 'nav_menu_item',
                        'route'             => route('users.index'),
                        'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-group'),
                        'display_name'      => __('messages.users'),
                    ],
                    [
                        'permission_name'   => 'statuses_menu',
                        'type'              => 'nav_menu_item',
                        'route'             => route('statuses.index'),
                        'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-list'),
                        'display_name'      => __('messages.statuses'),
                    ],
                    [
                        'permission_name'   => 'areas_menu',
                        'type'              => 'nav_menu_item',
                        'route'             => route('areas.index'),
                        'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-location-pin'),
                        'display_name'      => __('messages.areas'),
                    ],
                ],
            ],
            [
                'permission_name'   => 'operations_menu',
                'type'              => 'menu_header',
                'display_name'      => __('messages.operations'),
                'childs'            => 
                [
                    [
                        'permission_name'   => 'customers_menu',
                        'type'              => 'nav_menu_item',
                        'route'             => route('customers.index'),
                        'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-contact'),
                        'display_name'      => __('messages.customers'),
                    ],
                    [
                        'permission_name'   => 'orders_menu',
                        'type'              => 'nav_menu_item',
                        'route'             => route('orders.index'),
                        'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-library'),
                        'display_name'      => __('messages.orders'),
                    ],
                ],
            ],
            [
                'permission_name'   => 'dispatching_menu',
                'type'              => 'menu_header',
                'display_name'      => __('messages.dispatching'),
                'childs'            => $services,
            ],
            [
                'permission_name'   => 'reports_menu',
                'type'              => 'menu_header',
                'display_name'      => __('messages.reports'),
                'childs'            => 
                [
                    [
                        'permission_name'   => 'reports_menu',
                        'type'              => 'menu_dropdown',
                        'icon'              => asset('vendors/@coreui/icons/svg/free.svg#cil-chart-line'),
                        'display_name'      => __('messages.reports'),
                        'childs'            => 
                        [
                            [
                                'permission_name'   => 'reports_menu',
                                'type'              => 'nav_menu_item',
                                'route'             => route('reports.monthly_orders_statistics'),
                                'icon'              => '',
                                'display_name'      => __('messages.monthly_orders_statistics'),
                            ],
                            [
                                'permission_name'   => 'reports_menu',
                                'type'              => 'nav_menu_item',
                                'route'             => '',
                                'icon'              => '',
                                'display_name'      => __('messages.report2'),
                            ],
                            [
                                'permission_name'   => 'reports_menu',
                                'type'              => 'nav_menu_item',
                                'route'             => '',
                                'icon'              => '',
                                'display_name'      => __('messages.report3'),
                            ],
                        ],
                    ],
                ],
            ],
        ];
    @endphp

    <ul class="c-sidebar-nav">

        @if (auth()->id() == 1)  
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('artisan.index')}}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-browser')}}"></use>
                    </svg>
                    @lang('messages.artisan_commands')
                </a>
            </li>
        @endif

        @foreach ($nav_menu_items as $item)

            @switch($item['type'])

                {{-- Menu Header with Childs --}}
                @case('menu_header')
                    @include('includes.menu_header')
                @break

                {{-- Menu Dropdown with Childs --}}
                @case('menu_dropdown')
                    @include('includes.menu_dropdown')
                @break

                {{-- Nav Menu Items --}}
                @case('nav_menu_item')
                    @include('includes.nav_menu_item')
                @break

            @endswitch

        @endforeach
    </ul>

    <button 
        class="c-sidebar-minimizer c-class-toggler" 
        type="button" 
        data-target="_parent"
        data-class="c-sidebar-minimized"
    >
    </button>

</div>

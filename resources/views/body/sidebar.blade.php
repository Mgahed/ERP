<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="/">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="rounded-circle" src="{{asset('logo.jpeg')}}" width="50" height="50" alt="">
                        <h3><b>Spinel</b></h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{Request::is(app()->getLocale()) ? 'active' : ''}}">
                <a href="{{route('home')}}">
                    <i class="fa fa-dollar text-light"></i>
                    <span>{{__('Selling operation')}}</span>
                </a>
            </li>
            <li class="treeview {{Request::is(app()->getLocale().'/returns/*') ? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-shopping-bag"></i> <span>{{__('Returns')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is(app()->getLocale().'/returns/make') ? 'active' : ''}}"><a
                                href="{{route('make-returns')}}"><i class="ti-more"></i>{{__('Return')}}</a>
                    </li>
                    @if (auth()->user()->role === 'admin')
                        <li class="{{Request::is(app()->getLocale().'/returns/all') ? 'active' : ''}}"><a
                                    href="{{route('all-returns')}}"><i class="ti-more"></i>{{__('All returns')}}</a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="treeview {{Request::is(app()->getLocale().'/order/*') ? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-shopping-bag"></i> <span>{{__('Orders')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is(app()->getLocale().'/order/all') ? 'active' : ''}}"><a
                                href="{{route('all-order')}}"><i class="ti-more"></i>{{__('All orders')}}</a>
                    </li>
                    @if (auth()->user()->role === 'admin')
                        <li class="{{Request::is(app()->getLocale().'/order/deleted/all') ? 'active' : ''}}"><a
                                    href="{{route('deleted.orders')}}"><i class="ti-more"></i>{{__('Deleted orders')}}
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="treeview {{Request::is(app()->getLocale().'/category/*') ? 'active' : ''}}">
                <a href="#">
                    <i class="ti-layout-list-thumb-alt"></i> <span>{{__('Category')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is(app()->getLocale().'/category/view') ? 'active' : ''}}"><a
                                href="{{route('all.category')}}"><i class="ti-more"></i>{{__('All categories')}}</a>
                    </li>
                    <li class="{{Request::is(app()->getLocale().'/subcategory/view') ? 'active' : ''}}"><a
                                href="{{route('all.sub.category')}}"><i class="ti-more"></i>{{__('All subcategories')}}</a>
                    </li>
                    <li class="{{Request::is(app()->getLocale().'/sub-sub-category/view') ? 'active' : ''}}"><a
                            href="{{route('all.sub.sub.category')}}"><i class="ti-more"></i>{{__('All sub subcategories')}}</a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{Request::is(app()->getLocale().'/product/*') ? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-shopping-basket"></i> <span>{{__('Products')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is(app()->getLocale().'/product/add') ? 'active' : ''}}"><a
                                href="{{route('add-product')}}"><i class="ti-more"></i>{{__('Add products')}}</a></li>
                    <li class="{{Request::is(app()->getLocale().'/product/edit/*') ? 'active' : ''}}{{Request::is(app()->getLocale().'/product/manage') ? 'active' : ''}}">
                        <a
                                href="{{route('manage-product')}}"><i class="ti-more"></i>{{__('Manage products')}}</a>
                    </li>
                    @if (auth()->user()->role === 'admin')
                        <li class="{{Request::is(app()->getLocale().'/product/deleted') ? 'active' : ''}}">
                            <a
                                    href="{{route('deleted.products')}}"><i
                                        class="ti-more"></i>{{__('Deleted products')}}
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            @if (auth()->user()->role === 'admin')
                <li class="treeview {{Request::is(app()->getLocale().'/alluser/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>{{__('Users')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/alluser/*') ? 'active' : ''}}">
                            <a
                                    href="{{route('all-users')}}"><i class="ti-more"></i>{{__('All users')}}</a>
                        </li>
                        @if (auth()->user()->role === 'admin')
                            <li class="{{Request::is(app()->getLocale().'/register') ? 'active' : ''}}">
                                <a
                                        href="{{route('register')}}"><i class="ti-more"></i>{{__('Register new user')}}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="treeview {{Request::is(app()->getLocale().'/customer/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="mdi mdi-account-multiple"></i> <span>{{__('Customers')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/customer/view') ? 'active' : ''}}"><a
                                    href="{{route('all.customers')}}"><i class="ti-more"></i>{{__('All customers')}}</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview {{Request::is(app()->getLocale().'/reports/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="mdi mdi-note-text"></i> <span>{{__('Reports')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/reports/view') ? 'active' : ''}}"><a
                                    href="{{route('all-reports')}}"><i class="ti-more"></i>{{__('All reports')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>

    {{--<div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
           aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                class="ti-lock"></i></a>
    </div>--}}
</aside>

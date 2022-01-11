<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
        <!-- Sidebar toggle button-->
        <div>
            <ul class="nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon"
                       data-toggle="push-menu" role="button">
                        <i class="nav-link-icon mdi mdi-menu"></i>
                    </a>
                </li>
                <li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen"
                       class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
                        <i class="nav-link-icon mdi mdi-crop-free"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                @if (app()->getLocale()==='en')
                    <li class="btn-group nav-item" style="margin-top: 10px;">
                        <a rel="alternate" style="width: 100%" hreflang="ar"
                           class="waves-effect waves-light nav-link rounded dropdown-toggle p-0"
                           href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"><i title="العربية"
                                                                                                      class="flag-icon flag-icon-eg"></i></a>
                    </li>
                @else
                    <li class="btn-group nav-item" style="margin-top: 10px;">
                        <a rel="alternate" style="width: 100%" hreflang="en"
                           class="waves-effect waves-light nav-link rounded dropdown-toggle p-0"
                           href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"><i title="English"
                                                                                                      class="flag-icon flag-icon-us"></i></a>
                    </li>
                @endif
                {{--@php
                    $products = \App\Models\Product::where('quantity','<=',5)->get();
                @endphp
            <!-- Notifications -->
                @if ($products->count())
                    <li class="dropdown notifications-menu">
                        <a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown"
                           title="{{__('Notifications')}}">
                            <i class="ti-bell"></i>
                        </a>
                        <ul class="dropdown-menu animated bounceIn">
                            <li class="header">
                                <div class="p-20">
                                    <div class="flexbox">
                                        <div>
                                            <h4 class="mb-0 mt-0">{{__('Notifications')}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu sm-scrol">
                                    <li>
                                         <a href="{{route('in.notification')}}"
                                            title="{{__('There is ')}}{{$products->count()}}{{__(' products will almost finish.')}}">
                                             <i class="fa fa-shopping-basket text-danger"></i>
                                             {{__('There is ')}}{{$products->count()}}{{__(' products will almost finish.')}}
                                         </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
            @endif
            <!-- User Account-->--}}
                <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0" data-toggle="dropdown"
                       title="User">
                            <span class="inline-flex rounded-md">
                                <div id="name" class="d-none">{{ Auth::user()->name }}</div>
                                <div id="profileImage"></div>
                                </span>
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>

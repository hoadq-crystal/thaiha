<aside
    class="main-sidebar sidebar-{{ config('boilerplate.theme.sidebar.type') }}-{{ config('boilerplate.theme.sidebar.links.bg') }} elevation-{{ config('boilerplate.theme.sidebar.shadow') }}">
    <a href="{{ route('boilerplate.dashboard') }}"
       class="brand-link d-flex {{ !empty(config('boilerplate.theme.sidebar.brand.bg')) ? 'bg-'.config('boilerplate.theme.sidebar.brand.bg') : ''}}">
        <x-application-logo class="block h-12 w-auto" />
    </a>
    <div class="sidebar" style="margin-top: 80px">
        @if(config('boilerplate.theme.sidebar.user.visible'))
            <div class="user-panel d-flex align-items-center">
                <div class="image">
                    <img src="{{ Auth::user()->avatar_url }}"
                         class="avatar-img img-circle elevation-{{ config('boilerplate.theme.sidebar.user.shadow') }}"
                         alt="{{ Auth::user()->name }}">
                </div>
                <div class="info">
                    <a href="{{ route('boilerplate.user.profile') }}" class="d-flex flex-wrap">
                        <span class="mr-1">{{ Auth::user()->first_name }}</span>
                        <span
                            class="text-truncate text-uppercase font-weight-bolder">{{ Auth::user()->last_name }}</span>
                    </a>
                </div>
            </div>
        @endif
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview"
                data-accordion="false" role="menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('boilerplate.dashboard') }}"><i
                            class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p></a></li>
                <li order="1000" class="nav-item"><a class="nav-link"><i class="nav-icon fas fa-users"></i>
                        <p>Users</p><i class="fa fa-angle-left right"></i><i class="fa fa-angle-left right"></i><i
                            class="fa fa-angle-left right"></i><i class="fa fa-angle-left right"></i></a>
                    <ul class="nav nav-treeview">
                        <li order="1001" class="nav-item"><a class="nav-link"
                                                             href="{{ route('boilerplate.dashboard') }}/userprofile"><i
                                    class="nav-icon far fa-circle"></i>
                                <p>My profile</p></a></li>
                        <li order="1002" class="nav-item"><a class="nav-link"
                                                             href="{{ route('boilerplate.dashboard') }}/users/create"><i
                                    class="nav-icon far fa-circle"></i>
                                <p>Add a user</p></a></li>
                        <li order="1003" class="nav-item"><a class="nav-link"
                                                             href="{{ route('boilerplate.dashboard') }}/users"><i
                                    class="nav-icon far fa-circle"></i>
                                <p>User list</p></a></li>
                        <li order="1004" class="nav-item"><a class="nav-link"
                                                             href="{{ route('boilerplate.dashboard') }}/roles"><i
                                    class="nav-icon far fa-circle"></i>
                                <p>Roles</p></a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('boilerplate.dashboard') }}/articles"><i
                            class="nav-icon fas fa-newspaper"></i>
                        <p>Articles</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('boilerplate.dashboard') }}/products"><i
                            class="nav-icon fas fa-product-hunt"></i>
                        <p>Products</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('boilerplate.dashboard') }}/categories"><i
                            class="nav-icon fas fa-list-alt"></i>
                        <p>Categories</p></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('boilerplate.dashboard') }}/contacts"><i
                            class="nav-icon fas fa-address-book"></i>
                        <p>Contacts</p></a></li>
                <li order="1100" class="nav-item"><a class="nav-link"><i class="nav-icon fas fa-list"></i>
                        <p>Logs</p><i class="fa fa-angle-left right"></i><i class="fa fa-angle-left right"></i></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link" href="{{ route('boilerplate.dashboard') }}/logs"><i
                                    class="nav-icon far fa-circle"></i>
                                <p>Statistics</p></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('boilerplate.dashboard') }}/logs/list"><i
                                    class="nav-icon far fa-circle"></i>
                                <p>Reports</p></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>

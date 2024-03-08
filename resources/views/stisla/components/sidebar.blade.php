<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SPKL-PAL</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('dashboard-ecommerce-dashboard') }}">Ecommerce Dashboard</a>
                    </li>
                </ul>
            </li>
         
            <li class="menu-header">Starter</li>
            {{-- <li class="nav-item dropdown {{ $type_menu === 'layout' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('layout-default-layout') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('layout-default-layout') }}">Default Layout</a>
                    </li>
                    <li class="{{ Request::is('transparent-sidebar') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('transparent-sidebar') }}">Transparent Sidebar</a>
                    </li>
                    <li class="{{ Request::is('layout-top-navigation') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('layout-top-navigation') }}">Top Navigation</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('blank-page') }}"><i class="far fa-square"></i> <span>Blank Page</span></a>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'bootstrap' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('bootstrap-alert') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-alert') }}">Alert</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-badge') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-badge') }}">Badge</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-breadcrumb') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-breadcrumb') }}">Breadcrumb</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-buttons') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-buttons') }}">Buttons</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-card') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-card') }}">Card</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-carousel') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-carousel') }}">Carousel</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-collapse') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-collapse') }}">Collapse</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-dropdown') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-dropdown') }}">Dropdown</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-form') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-form') }}">Form</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-list-group') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-list-group') }}">List Group</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-media-object') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-media-object') }}">Media Object</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-modal') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-modal') }}">Modal</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-nav') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-nav') }}">Nav</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-navbar') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-navbar') }}">Navbar</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-pagination') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-pagination') }}">Pagination</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-popover') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-popover') }}">Popover</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-progress') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-progress') }}">Progress</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-table') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-table') }}">Table</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-tooltip') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-tooltip') }}">Tooltip</a>
                    </li>
                    <li class="{{ Request::is('bootstrap-typography') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('bootstrap-typography') }}">Typography</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Stisla</li>
            <li class="nav-item dropdown {{ $type_menu === 'components' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Components</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('components-article') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('components-article') }}">Article</a>
                    </li>
                    <li class="{{ Request::is('components-avatar') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar"
                            href="{{ url('components-avatar') }}">Avatar</a>
                    </li>
                    <li class="{{ Request::is('components-chat-box') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('components-chat-box') }}">Chat Box</a>
                    </li>
                    <li class="{{ Request::is('components-empty-state') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar"
                            href="{{ url('components-empty-state') }}">Empty State</a>
                    </li>
                    <li class="{{ Request::is('components-gallery') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('components-gallery') }}">Gallery</a>
                    </li>
                    <li class="{{ Request::is('components-hero') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar"
                            href="{{ url('components-hero') }}">Hero</a>
                    </li>
                    <li class="{{ Request::is('components-multiple-upload') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('components-multiple-upload') }}">Multiple Upload</a>
                    </li>
                    <li class="{{ Request::is('components-pricing') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar"
                            href="{{ url('components-pricing') }}">Pricing</a>
                    </li>
                    <li class="{{ Request::is('components-statistic') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('components-statistic') }}">Statistic</a>
                    </li>
                    <li class="{{ Request::is('components-tab') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('components-tab') }}">Tab</a>
                    </li>
                    <li class="{{ Request::is('components-table') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('components-table') }}">Table</a>
                    </li>
                    <li class="{{ Request::is('components-user') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('components-user') }}">User</a>
                    </li>
                    <li class="{{ Request::is('components-wizard') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar"
                            href="{{ url('components-wizard') }}">Wizard</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'forms' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('forms-advanced-form') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('forms-advanced-form') }}">Advanced Form</a>
                    </li>
                    <li class="{{ Request::is('forms-editor') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('forms-editor') }}">Editor</a>
                    </li>
                    <li class="{{ Request::is('forms-validation') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('forms-validation') }}">Validation</a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i> <span>Google
                        Maps</span></a>
                <ul class="dropdown-menu">
                    <li><a href="gmaps-advanced-route.html">Advanced Route</a></li>
                    <li><a href="gmaps-draggable-marker.html">Draggable Marker</a></li>
                    <li><a href="gmaps-geocoding.html">Geocoding</a></li>
                    <li><a href="gmaps-geolocation.html">Geolocation</a></li>
                    <li><a href="gmaps-marker.html">Marker</a></li>
                    <li><a href="gmaps-multiple-marker.html">Multiple Marker</a></li>
                    <li><a href="gmaps-route.html">Route</a></li>
                    <li><a href="gmaps-simple.html">Simple</a></li>
                </ul>
            </li> --}}
            {{--   --}}
    </aside>
</div>

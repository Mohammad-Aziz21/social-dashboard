<div id="menu-sidbar" class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Admin</li>
    
                            <li>
                                <a href="{{ route('operator.index') }}">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Operators</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.index') }}">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-layouts">Customers</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('record.index') }}" class="waves-effect">
                                    <i class="bx bx-receipt"></i>
                                    <span key="t-layouts">Records</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('type.index') }}" class="waves-effect">
                                    <i class="bx bx-file"></i>
                                    <span key="t-layouts">Types</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('logout.perform') }}" class="waves-effect">
                                    <i class="bx bx-file"></i>
                                    <span key="t-layouts">Logout</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
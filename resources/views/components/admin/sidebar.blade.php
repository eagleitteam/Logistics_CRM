<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo_sm.png') }}" alt="" height="50" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo_lg.png') }}" alt="" height="50" />
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo_sm.png') }}" alt="" height="50" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo_lg.png') }}" alt="" height="50" />
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>

                @canany(['dashboard.view'])
                <li class="nav-item">
                    <a class="nav-link menu-link  {{ request()->routeIs('dashboard') ? 'active' : 'collapsed' }}" href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                @endcan

                @canany(['wards.view'])
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('wards.index') || request()->routeIs('departments.index') || request()->routeIs('class.index') || request()->routeIs('bank.index') || request()->routeIs('financial_year.index') || request()->routeIs('allowance.index') || request()->routeIs('deduction.index') || request()->routeIs('loan.index') || request()->routeIs('designation.index') || request()->routeIs('leaveType.index') || request()->routeIs('pay_scale.index') || request()->routeIs('document.index') || request()->routeIs('users.index') || request()->routeIs('roles.index') || request()->routeIs('working-department.index') || request()->routeIs('castes.index') ? 'active' : 'collapsed' }}" href="#sidebarAuth1" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth1">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Masters</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('wards.index') || request()->routeIs('departments.index') || request()->routeIs('class.index') || request()->routeIs('bank.index') || request()->routeIs('financial_year.index') || request()->routeIs('allowance.index') || request()->routeIs('deduction.index') || request()->routeIs('loan.index') || request()->routeIs('designation.index') || request()->routeIs('leaveType.index') || request()->routeIs('pay_scale.index') || request()->routeIs('document.index') || request()->routeIs('users.index') || request()->routeIs('roles.index') || request()->routeIs('working-department.index') || request()->routeIs('castes.index') ? 'show' : '' }}" id="sidebarAuth1">
                        <ul class="nav nav-sm flex-column">
                            @canany(['users.view', 'roles.view'])
                            <li class="nav-item">
                                <a href="#sidebarSignUp" class="nav-link {{ request()->routeIs('users.index') || request()->routeIs('roles.index') ? 'active' : '' }}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignUp" data-key="t-signup"> User Management
                                </a>
                                <div class="collapse menu-dropdown {{ request()->routeIs('users.index') || request()->routeIs('roles.index') ? 'show' : '' }}" id="sidebarSignUp">
                                    <ul class="nav nav-sm flex-column">
                                        @can('users.view')
                                            <li class="nav-item">
                                                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" data-key="t-horizontal">Users</a>
                                            </li>
                                        @endcan
                                        @can('roles.view')
                                            <li class="nav-item">
                                                <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}" data-key="t-horizontal">Roles</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                            @endcanany
                            <!-- @can('wards.view')
                                <li class="nav-item">
                                    <a href="{{ route('wards.index') }}" class="nav-link {{ request()->routeIs('wards.index') ? 'active' : '' }}" data-key="t-horizontal">Wards</a>
                                </li>
                            @endcan -->
                                <li class="nav-item">
                                    <a href="{{ route('vehicle-types.index') }}" class="nav-link {{ request()->routeIs('vehicle-types.index') ? 'active' : '' }}" data-key="t-horizontal">Vehicle Type</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('self-vehicle.index') }}" class="nav-link {{ request()->routeIs('self-vehicle.index') ? 'active' : '' }}" data-key="t-horizontal">Add Vehicle</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('master-group.index') }}" class="nav-link {{ request()->routeIs('master-group.index') ? 'active' : '' }}" data-key="t-horizontal">Master Group</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('group-master-category.index') }}" class="nav-link {{ request()->routeIs('group-master-category.index') ? 'active' : '' }}" data-key="t-horizontal">Master Group Category</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sub-group-master.index') }}" class="nav-link {{ request()->routeIs('sub-group-master.index') ? 'active' : '' }}" data-key="t-horizontal">Sub Group Master</a>
                                </li>
                                @can('yearmasters.view')
                                    <li class="nav-item">
                                        <a href="{{ route('year-master.index') }}" class="nav-link {{ request()->routeIs('year-master.index') ? 'active' : '' }}" data-key="t-horizontal">Year Master</a>
                                    </li>
                                @endcan
                                @can('statemasters.view')
                                    <li class="nav-item">
                                        <a href="{{ route('state-master.index') }}" class="nav-link {{ request()->routeIs('state-master.index') ? 'active' : '' }}" data-key="t-horizontal">State Master</a>
                                    </li>
                                @endcan
                                @can('vendormaster.view')
                                    <li class="nav-item">
                                        <a href="{{ route('vendor-master.index') }}" class="nav-link {{ request()->routeIs('vendor-master.index') ? 'active' : '' }}" data-key="t-horizontal">Vendor Master</a>
                                    </li>
                                @endcan
                                @can('clientmaster.view')
                                    <li class="nav-item">
                                        <a href="{{ route('client-master.index') }}" class="nav-link {{ request()->routeIs('client-master.index') ? 'active' : '' }}" data-key="t-horizontal">Client Master</a>
                                    </li>
                                @endcan
                                @can('drivermaster.view')
                                    <li class="nav-item">
                                        <a href="{{ route('driver-master.index') }}" class="nav-link {{ request()->routeIs('driver-master.index') ? 'active' : '' }}" data-key="t-horizontal">Driver Master</a>
                                    </li>
                                @endcan
                                @can('gstmaster.view')
                                    <li class="nav-item">
                                        <a href="{{ route('gst-master.index') }}" class="nav-link {{ request()->routeIs('gst-master.index') ? 'active' : '' }}" data-key="t-horizontal">GST Master</a>
                                    </li>
                                @endcan
                                @can('fuelmaster.view')
                                    <li class="nav-item">
                                        <a href="{{ route('fuel-master.index') }}" class="nav-link {{ request()->routeIs('fuel-master.index') ? 'active' : '' }}" data-key="t-horizontal">Fuel Master</a>
                                    </li>
                                @endcan
                                @can('tripmovement.view')
                                    <li class="nav-item">
                                        <a href="{{ route('trip-movement.index') }}" class="nav-link {{ request()->routeIs('trip-movement.index') ? 'active' : '' }}" data-key="t-horizontal">Trip Movement</a>
                                    </li>
                                @endcan
                                @can('Podtripmovement.view')
                                    <li class="nav-item">
                                        <a href="{{ route('trip-movement-curier-list.index') }}" class="nav-link {{ request()->routeIs('trip-movement-curier-list.index') ? 'active' : '' }}" data-key="t-horizontal">Trip Movement Curier</a>
                                    </li>
                                @endcan
                                @can('bankmaster.view')
                                    <li class="nav-item">
                                        <a href="{{ route('bank-master.index') }}" class="nav-link {{ request()->routeIs('bank-master.index') ? 'active' : '' }}" data-key="t-horizontal">Bank Master</a>
                                    </li>
                                @endcan
                                @can('departmentmasters.view')
                                    <li class="nav-item">
                                        <a href="{{ route('department-master.index') }}" class="nav-link {{ request()->routeIs('department-master.index') ? 'active' : '' }}" data-key="t-horizontal">Department Master</a>
                                    </li>
                                @endcan
                                @can('branchmaster.view')
                                    <li class="nav-item">
                                        <a href="{{ route('branch-master.index') }}" class="nav-link {{ request()->routeIs('branch-master.index') ? 'active' : '' }}" data-key="t-horizontal">Branch Master</a>
                                    </li>
                                @endcan
                                @can('companybillingmaster.view')
                                    <li class="nav-item">
                                        <a href="{{ route('company-billing-master.index') }}" class="nav-link {{ request()->routeIs('company-billing-master.index') ? 'active' : '' }}" data-key="t-horizontal">Company Billing Data Master</a>
                                    </li>
                                @endcan
                                @can('numberingprefix.view')
                                    <li class="nav-item">
                                        <a href="{{ route('numbering-prefix-master.index') }}" class="nav-link {{ request()->routeIs('numbering-prefix-master.index') ? 'active' : '' }}" data-key="t-horizontal">Numbering Prefix Master</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcanany
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>


<div class="vertical-overlay"></div>

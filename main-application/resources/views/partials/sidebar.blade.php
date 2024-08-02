<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li class="mb-2">
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title" key="t-apps">Modules</li>

                <li class="mb-2">
                    <a href="#" class="waves-effect">
                        <i class="bx bx-credit-card"></i> <!-- Payment icon -->
                        <span key="t-contacts">Payments</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('invoice.index') }}" class="waves-effect">
                        <i class="bx bx-receipt"></i> <!-- Invoice icon -->
                        <span key="t-contacts">Invoice</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="waves-effect">
                        <i class="bx bx-bar-chart"></i> <!-- Reports icon -->
                        <span key="t-contacts">Reports</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a class="waves-effect has-arrow">
                        <i class="bx bx-cog"></i> <!-- Settings icon -->
                        <span key="t-invoices">Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="mb-2"><a href="#" key="t-p-grid"><i class="bx bx-store"></i> Merchants</a>
                        </li>
                        <li class="mb-2"><a href="#" key="t-p-grid"><i class="bx bx-tag"></i> Brands</a></li>
                        <li class="mb-2"><a href="#" key="t-p-grid"><i class="bx bx-wrench"></i> Services</a>
                        </li>
                        <li class="mb-2"><a href="#" key="t-p-grid"><i class="bx bx-user-check"></i> Roles</a>
                        </li>
                        <li class="mb-2"><a href="#" key="t-p-grid"><i class="bx bx-user"></i> Users</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>

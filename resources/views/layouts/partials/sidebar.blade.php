<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">ACQUISITION</a>
        </div>
        {{-- SIDEBAR --}}
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">TA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">DATA</li>
            <li class="{{ request()->routeIs('admin.data.order.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.data.order.index') }}">
                    <i class="fas fa-archive"></i> <span>Order</span>
                </a>
            </li>
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li> --}}
            {{-- @role('admin') --}}
            <li class="menu-header">Master Data</li>
            <li class="{{ request()->routeIs('admin.master.promo.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.master.promo.index') }}">
                    <i class="fas fa-database"></i> <span>Master Kode Promo</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.master.sku.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.master.sku.index') }}">
                    <i class="fas fa-server"></i> <span>Master SKU Produk</span>
                </a>
            </li>
            {{-- @endrole --}}
            <li class="menu-header">Management User</li>
            <li class="{{ request()->routeIs('admin.personil.user.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.personil.user.index') }}">
                    <i class="fas fa-user"></i> <span>Pegawai</span>
                </a>
            </li>
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="forms-advanced-form.html">Advanced Form</a></li>
                    <li><a class="nav-link" href="forms-editor.html">Editor</a></li>
                    <li><a class="nav-link" href="forms-validation.html">Validation</a></li>
                </ul>
            </li> --}}
            {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
            </div>         --}}
    </aside>
</div>
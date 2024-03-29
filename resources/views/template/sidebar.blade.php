<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        {{-- <li class="sidebar-item {{ Request::is('kategoris') ? 'active' : '' }}">
            <a href="{{ route('kategoris.index') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Kategori</span>
            </a>
        </li> --}}
        <li class="sidebar-item {{ Request::is('barangs*', 'kategoris*') ? 'active' : '' }} has-sub">
            <a href="#" class="sidebar-link">
                <i class="bi bi-stack"></i>
                <span>Barang</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('barangs') ? 'active' : '' }}">
                    <a href="{{ route('barangs.index') }}">Barang</a>
                </li>
                <li class="submenu-item {{ Request::is('kategoris') ? 'active' : '' }}">
                    <a href="{{ route('kategoris.index') }}">Kategori Barang</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-title">Warung</li>
        <li class="sidebar-item {{ Request::is('belanja') ? 'active' : '' }}">
            <a href="{{ route('belanja') }}" class="sidebar-link">
                <i class="bi bi-cart2"></i>
                <span>Belanja</span>
            </a>
        </li>
    </ul>
</div>
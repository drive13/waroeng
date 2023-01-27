<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item {{ Request::is('barangs*') ? 'active' : '' }} has-sub">
            <a href="#" class="sidebar-link">
                <i class="bi bi-stack"></i>
                <span>Barang</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item {{ Request::is('barangs') ? 'active' : '' }}">
                    <a href="{{ route('barangs.index') }}">Daftar Barang</a>
                </li>
                <li class="submenu-item">
                    <a href="#">Tooltip</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item has-sub">
            <a href="#" class="sidebar-link">
                <i class="bi bi-collection-fill"></i>
                <span>Extra Components</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item">
                    <a href="extra-component-avatar.html"
                        >Avatar</a
                    >
                </li>
                <li class="submenu-item">
                    <a
                        href="extra-component-sweetalert.html"
                        >Sweet Alert</a
                    >
                </li>
                <li class="submenu-item">
                    <a href="extra-component-toastify.html"
                        >Toastify</a
                    >
                </li>
                <li class="submenu-item">
                    <a href="extra-component-rating.html"
                        >Rating</a
                    >
                </li>
                <li class="submenu-item">
                    <a href="extra-component-divider.html"
                        >Divider</a
                    >
                </li>
            </ul>
        </li>

    </ul>
</div>
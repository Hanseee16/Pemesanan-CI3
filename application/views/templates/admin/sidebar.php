<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '' ? 'active' : 'collapsed'; ?>" href="<?= base_url('admin'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= in_array($this->uri->segment(2), ['kategori', 'menu']) ? '' : 'collapsed'; ?>" data-bs-target="#dataMaster" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="dataMaster" class="nav-content collapse <?= in_array($this->uri->segment(2), ['kategori', 'menu']) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('admin/kategori'); ?>" class="<?= $this->uri->segment(2) == 'kategori' ? 'active' : 'collapsed'; ?>">
                        <i class="bi bi-circle"></i><span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/menu'); ?>" class="<?= $this->uri->segment(2) == 'menu' ? 'active' : 'collapsed'; ?>">
                        <i class="bi bi-circle"></i><span>Menu</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'transaksi' || $this->uri->segment(2) == 'detail_transaksi' ? 'active' : 'collapsed'; ?>" href="<?= base_url('admin/transaksi'); ?>">
                <i class="bi bi-person"></i>
                <span>Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'laporan' ? 'active' : 'collapsed'; ?>" href="<?= base_url('admin/laporan'); ?>">
                <i class="bi bi-person"></i>
                <span>Laporan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'registrasi' ? 'active' : 'collapsed'; ?>" href="<?= base_url('admin/registrasi'); ?>">
                <i class="bi bi-person"></i>
                <span>Registrasi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'profile' ? 'active' : 'collapsed'; ?>" href="<?= base_url('admin/profile'); ?>">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('logout'); ?>">
                <i class="bi bi-file-earmark"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
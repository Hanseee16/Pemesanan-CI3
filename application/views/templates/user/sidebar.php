<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == '' ? 'active' : 'collapsed'; ?>" href="<?= base_url('user'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'daftar_menu' ? 'active' : 'collapsed'; ?>" href="<?= base_url('user/daftar_menu'); ?>">
                <i class="bi bi-person"></i>
                <span>Daftar Menu</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'keranjang' || $this->uri->segment(2) == 'checkout' ? 'active' : 'collapsed'; ?>" href="<?= base_url('user/keranjang'); ?>">
                <i class="bi bi-person"></i>
                <span>Keranjang</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'transaksi' || $this->uri->segment(2) == 'detail_transaksi' || $this->uri->segment(2) == 'pembayaran' ? 'active' : 'collapsed'; ?>" href="<?= base_url('user/transaksi'); ?>">
                <i class="bi bi-person"></i>
                <span>Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'profile' ? 'active' : 'collapsed'; ?>" href="<?= base_url('user/profile'); ?>">
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
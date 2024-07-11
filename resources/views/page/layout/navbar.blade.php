<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="{{ route('page_home') }}" class="logo">
                        Unit Kerjasama Poliwangi
                    </a>
                    <ul class="nav">
                        <li class="has-sub">
                            <a href="javascript:void(0)">Home</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('page_struktur') }}">Struktur Organisasi</a></li>
                                <li><a href="{{ route('page_visi_misi') }}">Visi dan Misi</a></li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a href="javascript:void(0)">Berita</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('page_aktivitas') }}">Kegiatan Kerjasama</a></li>
                                <li><a href="{{ route('page_panduan') }}">Paduan Pengajuan Kerjasama</a></li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a href="javascript:void(0)">Links</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('page_download') }}">Download File MoU</a></li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a href="javascript:void(0)">Patners</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('page_kerjasama') }}">Daftar Kerjasama</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                </nav>
            </div>
        </div>
    </div>
</header>

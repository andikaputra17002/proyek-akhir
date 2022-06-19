<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand"
                    href="../../../html/ltr/vertical-menu-template/index.html">
                    {{-- <div class=""></div> --}}
                    <h2 class="brand-text mb-0">Dokter Umum</h2>
                    {{-- <h2 class="brand-text mb-0">Umum</h2> --}}
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                        class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- <li class=" nav-item"><a href="index.html"><i class="feather icon-home"></i><span class="menu-title"
                        data-i18n="Dashboard">Dashboard</span></a>
            </li> --}}

            <li class=" nav-item"><a href="{{ route('pasien.index') }}"><i class="feather icon-user"></i><span
                        class="menu-title">Data Pasien</span></a>
            </li>
            <li class=" nav-item"><a href="{{ route('user.index') }}"><i class="feather icon-users"></i><span
                        class="menu-title" data-i18n="Chat">Data Petugas</span></a>
            </li>
            <li class=" nav-item"><a href="{{ route('pendaftaran.index') }}"><i class="feather icon-file-text"></i><span
                        class="menu-title" data-i18n="Chat">Data Pendaftaran</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-user-md"></i><span class="menu-title"
                        data-i18n="User">Data Dokter</span></a>
                <ul class="menu-content">
                    <li><a href="{{ route('dokter.index') }}"><i class="feather icon-circle"></i><span class="menu-item"
                                data-i18n="List">Dokter</span></a>
                    </li>
                    <li><a href="{{ route('haripraktek.index') }}"><i class="feather icon-circle"></i><span
                                class="menu-item" data-i18n="View">Hari Praktek Dokter</span></a>
                    </li>
                    <li><a href="{{ route('jampraktek.index') }}"><i class="feather icon-circle"></i><span
                                class="menu-item" data-i18n="View">Jam Praktek Dokter</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="{{ route('notifikasi.index') }}"><i
                        class="feather icon-message-square"></i><span class="menu-title"
                        data-i18n="Chat">Notifikasi</span></a>
            </li>
        </ul>
    </div>
</div>
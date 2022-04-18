<nav class="sidebar-nav">
    <ul class="nav in side-menu">
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Müşteriler</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('musteriler.index') }}">Müşteri Listesi</a>
                </li>
                <li>
                    <a href="{{ route('musteriler.create') }}">Yeni Müşteri Ekle</a>
                </li>

            </ul>
        </li>
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-edit-2"></i> <span class="hide-menu">Kalemler</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li><a href="{{ route('kalem.index') }}">Kalem Listesi</a>
                </li>
                <li><a href="{{ route('kalem.create') }}">Kalem Ekle</a>
                </li>

            </ul>
        </li>
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-file-text"></i> <span class="hide-menu">Faturalar</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('fatura.index') }}">Fatura Listesi</a>
                </li>
                <li>
                    <a href="{{ route('fatura.create',['type'=>0]) }}">Yeni Gelir Faturası Ekle</a>
                </li>
                <li>
                    <a href="{{ route('fatura.create',['type'=>1]) }}">Yeni Gider Faturası Ekle</a>
                </li>

            </ul>
        </li>
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-credit-card"></i> <span class="hide-menu">Banka</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('banka.index') }}">Banka Listesi</a>
                </li>
                <li>
                    <a href="{{ route('banka.create') }}">Yeni Banka Ekle</a>
                </li>

            </ul>
        </li>
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-activity"></i> <span class="hide-menu">İşlemler</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('islem.index')}}">İşlem Listesi</a>
                </li>
                <li>
                    <a href="{{ route('islem.create',['type'=>0]) }}">Ödeme Yap</a>
                </li>
                <li>
                    <a href="{{ route('islem.create',['type'=>1]) }}">Tahsilat Al</a>
                </li>

            </ul>
        </li>
    </ul>
    <!-- /.side-menu -->
</nav>

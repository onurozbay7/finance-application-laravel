<nav class="sidebar-nav d-print-none">
    <ul class="nav in side-menu">
        @if(\App\Models\UserPermission::getMyControl(0))
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-user"></i> <span class="hide-menu">Müşteriler</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('musteriler.index') }}">Müşteri Listesi</a>
                </li>
                <li>
                    <a href="{{ route('musteriler.create') }}">Müşteri Ekle</a>
                </li>

            </ul>
        </li>
        @endif



        @if(\App\Models\UserPermission::getMyControl(1))
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-file-text"></i> <span class="hide-menu">Fişler</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('fis.index') }}">Fiş Listesi</a>
                </li>
                <li>
                    <a href="{{ route('fis.create',['type'=>0]) }}">Gelir Fişi Ekle</a>
                </li>
                <li>
                    <a href="{{ route('fis.create',['type'=>1]) }}">Gider Fişi Ekle</a>
                </li>

            </ul>
        </li>
        @endif

            @if(\App\Models\UserPermission::getMyControl(2) || \App\Models\UserPermission::getMyControl(12) || \App\Models\UserPermission::getMyControl(13))
                <li class="menu-item-has-children">
                    <a href="javascript:void(0);">
                        <i class="list-icon feather feather-package"></i> <span class="hide-menu">Ürünler</span>
                    </a>
                    <ul class="list-unstyled sub-menu">
                        @if(\App\Models\UserPermission::getMyControl(12))
                        <li>
                            <a href="{{ route('kapi.index')}}">Kapı Listesi</a>
                        </li>
                        <li>
                            <a href="{{ route('kapi.create') }}">Kapı Ekle</a>
                        </li>
                        @endif

                        @if(\App\Models\UserPermission::getMyControl(13))
                        <li>
                            <a href="{{ route('kapak.index')}}">Kapak Listesi</a>
                        </li>
                        <li>
                            <a href="{{ route('kapak.create') }}">Kapak Ekle</a>
                        </li>
                        @endif

                        @if(\App\Models\UserPermission::getMyControl(2))
                        <li>
                            <a href="{{ route('urun.index') }}">Mdf&Hırdavat Listesi</a>
                        </li>
                        <li>
                            <a href="{{ route('urun.create') }}">Mdf&Hırdavat Ekle</a>
                        </li>
                        @endif

                    </ul>
                </li>
            @endif

        @if(\App\Models\UserPermission::getMyControl(3))
        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-credit-card"></i> <span class="hide-menu">Banka</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('banka.index') }}">Banka Listesi</a>
                </li>
                <li>
                    <a href="{{ route('banka.create') }}">Banka Ekle</a>
                </li>
                <li>
                    <a href="{{ route('banka.transfer') }}">Transfer Yap</a>
                </li>

            </ul>
        </li>
        @endif

        @if(\App\Models\UserPermission::getMyControl(4))
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
        @endif


            @if(\App\Models\UserPermission::getMyControl(8) || \App\Models\UserPermission::getMyControl(9))
            <li class="menu-item-has-children">
                <a href="javascript:void(0);">
                    <i class="list-icon feather feather-briefcase"></i> <span class="hide-menu">Personel</span>
                </a>
                <ul class="list-unstyled sub-menu">
                    @if(\App\Models\UserPermission::getMyControl(8))
                    <li>
                        <a href="{{ route('personel.index') }}">Personel Listesi</a>
                    </li>
                    <li>
                        <a href="{{ route('personel.create') }}">Personel Ekle</a>
                    </li>
                    @endif
                        @if(\App\Models\UserPermission::getMyControl(9))
                    <li>
                        <a href="{{ route('personelIslem.index') }}">Personel İşlem Listesi</a>
                    </li>
                    <li>
                        <a href="{{ route('personelIslem.create') }}">Personel İşlem Yap</a>
                    </li>
                        @endif

                </ul>
            </li>
            @endif
            @if(\App\Models\UserPermission::getMyControl(10) || \App\Models\UserPermission::getMyControl(11))
                <li class="menu-item-has-children">
                    <a href="javascript:void(0);">
                        <i class="list-icon feather feather-bookmark"></i> <span class="hide-menu">@if(\App\Models\UserPermission::getMyControl(10))Takvim & @endif Notlar</span>
                    </a>
                    <ul class="list-unstyled sub-menu">
                        @if(\App\Models\UserPermission::getMyControl(11))
                        <li>
                            <a href="{{ route('notlar.index')}}">Not Listesi</a>
                        </li>
                        <li>
                            <a href="{{ route('notlar.create',['type'=>0]) }}">Not Ekle</a>
                        </li>
                        @endif
                        @if(\App\Models\UserPermission::getMyControl(10))
                        <li>
                            <a href="{{ route('takvim.index') }}">Takvim</a>
                        </li>
                            @endif

                    </ul>
                </li>
            @endif
    </ul>
    <!-- /.side-menu -->
</nav>

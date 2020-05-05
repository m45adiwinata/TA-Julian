<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html">AIU</a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li{{$page == 'home' ? ' class=active' : ''}}>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li{{$page == 'home' ? ' class=active' : ''}}><a href="/">Home</a></li>
                            <li{{$page == 'history_pembelian' ? ' class=active' : ''}}><a href="/history-pembelian">History Pembelian</a></li>
                            <li{{$page == 'history_penjualan' ? ' class=active' : ''}}><a href="/history-penjualan">History Penjualan</a></li>
                        </ul>
                    </li>
                    @if($page == 'eoq')
                    <li class="active">
                    @else
                    <li>
                    @endif
                        <a href="eoq" aria-expanded="true"><i class="fa fa-balance-scale"></i><span>EOQ</span></a>
                    </li>
                    @if($page == 'data_penjualan' || $page == 'buat_penjualan')
                    <li class="active">
                    @else
                    <li>
                    @endif
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-money"></i><span>penjualan</span></a>
                        <ul class="collapse">
                            <li{{$page == 'data_penjualan' ? ' class=active' : ''}}><a href="/penjualan">Data Penjualan</a></li>
                            <li{{$page == 'buat_penjualan' ? ' class=active' : ''}}><a href="{{route('penjualan.create')}}">Buat Penjualan</a></li>
                        </ul>
                    </li>
                    @if($page == 'data_pembelian' || $page == 'buat_pembelian')
                    <li class="active">
                    @else
                    <li>
                    @endif
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-table"></i>
                            <span>Pembelian</span></a>
                        <ul class="collapse">
                            <li{{$page == 'data_pembelian' ? ' class=active' : ''}}><a href="/pembelian">Data Pembelian</a></li>
                            <li{{$page == 'buat_pembelian' ? ' class=active' : ''}}><a href="/pembelian/create">Buat Pembelian</a></li>
                        </ul>
                    </li>
                    @if($page == 'stok')
                    <li class="active">
                    @else
                    <li>
                    @endif
                        <a href="stok-barang" aria-expanded="true"><i class="fa fa-wikipedia-w"></i><span>Stok Barang</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
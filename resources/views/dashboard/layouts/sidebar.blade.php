<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-[#293649] focus:outline-none focus:ring-2 focus:ring-gray-200">
    <span class="sr-only">Open sidebar</span>
    <span class="material-symbols-rounded">
        menu
    </span>
</button>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-[#1B232E]">
        <a href="#" class="flex items-center pl-2.5 mb-5">
            <span class="self-center text-4xl font-bold whitespace-nowrap"><span class="text-[#8ED145]">De</span><span
                    class="text-[#F1F8FE]">Lay</span></span>
        </a>
        <ul class="space-y-2 font-medium border-t border-[#F1F8FE] py-2">
            <li>
                <a href="/" class="flex items-center p-2 text-[#F1F8FE] rounded-lg hover:bg-[#293649]">
                    <span class="material-symbols-rounded">
                        home
                    </span>
                    <span class="ml-3">Beranda</span>
                </a>
            </li>
            <li>
                <a href="/dashboard" class="flex items-center p-2 text-[#F1F8FE] rounded-lg hover:bg-[#293649]">
                    <span class="material-symbols-rounded">
                        dashboard
                    </span>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/profile" class="flex items-center p-2 text-[#F1F8FE] rounded-lg hover:bg-[#293649]">
                    <span class="material-symbols-rounded">
                        account_circle
                    </span>
                    <span class="flex-1 ml-3 whitespace-nowrap">Profile</span>
                </a>
            </li>
        </ul>
        <ul class="space-y-2 font-medium border-t border-[#F1F8FE] py-2">
            @can('farmer')
                <li>
                    <a href="/dashboard/monitor" class="flex items-center p-2 text-[#F1F8FE] rounded-lg hover:bg-[#293649]">
                        <span class="material-symbols-rounded">
                            calendar_month
                        </span>
                        <span class="flex-1 ml-3 whitespace-nowrap">Penjadwalan</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg group hover:bg-[#293649]"
                        aria-controls="dropdown-produk" data-collapse-toggle="dropdown-produk">
                        <span class="material-symbols-rounded">
                            inventory_2
                        </span>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Produk</span>
                        <span class="material-symbols-rounded">
                            expand_more
                        </span>
                    </button>
                    <ul id="dropdown-produk" class="hidden py-2 space-y-2">
                        <li>
                            <a href="/dashboard/product"
                                class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg pl-11 group hover:bg-[#293649]">Produk</a>
                        </li>
                        <li>
                            <a href="/dashboard/order"
                                class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg pl-11 group hover:bg-[#293649]">Pemesanan</a>
                        </li>
                        {{-- ini uncomment kalau mau pakai riwayat --}}
                        {{-- <li>
                            <a href="/dashboard/history"
                                class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg pl-11 group hover:bg-[#293649]">Riwayat</a>
                        </li> --}}
                    </ul>
                </li>
            @endcan
            @can('produsen')
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg group hover:bg-[#293649]"
                        aria-controls="dropdown-produk" data-collapse-toggle="dropdown-produk">
                        <span class="material-symbols-rounded">
                            inventory_2
                        </span>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Produk</span>
                        <span class="material-symbols-rounded">
                            expand_more
                        </span>
                    </button>
                    <ul id="dropdown-produk" class="hidden py-2 space-y-2">
                        <li>
                            <a href="/dashboard/market"
                                class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg pl-11 group hover:bg-[#293649]">Bahan
                                Baku</a>
                        </li>
                        <li>
                            <a href="/dashboard/order"
                                class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg pl-11 group hover:bg-[#293649]">Pemesanan</a>
                        </li>
                        <li>
                            <a href="/dashboard/history"
                                class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg pl-11 group hover:bg-[#293649]">Riwayat</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @canany(['farmer', 'produsen'])
                <li>
                    <a href="/dashboard/analysis"
                        class="flex items-center p-2 text-[#F1F8FE] rounded-lg hover:bg-[#293649]">
                        <span class="material-symbols-rounded">
                            bar_chart_4_bars
                        </span>
                        <span class="flex-1 ml-3 whitespace-nowrap">Analisis</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg group hover:bg-[#293649]"
                        aria-controls="dropdown-forum" data-collapse-toggle="dropdown-forum">
                        <span class="material-symbols-rounded">
                            forum
                        </span>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Forum</span>
                        <span class="material-symbols-rounded">
                            expand_more
                        </span>
                    </button>
                    <ul id="dropdown-forum" class="hidden py-2 space-y-2">
                        <li>
                            <a href="/dashboard/forum"
                                class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg pl-11 group hover:bg-[#293649]">Dashboard</a>
                        </li>
                        <li>
                            <a href="/dashboard/forums"
                                class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg pl-11 group hover:bg-[#293649]">Global</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('admin')
                <li>
                    <a href="/dashboard/advertisement"
                        class="flex items-center p-2 text-[#F1F8FE] rounded-lg hover:bg-[#293649]">
                        <span class="material-symbols-rounded">
                            featured_video
                        </span>
                        <span class="flex-1 ml-3 whitespace-nowrap">Iklan</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg group hover:bg-[#293649]"
                        aria-controls="dropdown-forum" data-collapse-toggle="dropdown-forum">
                        <span class="material-symbols-rounded">
                            forum
                        </span>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Forum</span>
                        <span class="material-symbols-rounded">
                            expand_more
                        </span>
                    </button>
                    <ul id="dropdown-forum" class="hidden py-2 space-y-2">
                        <li>
                            <a href="/dashboard/forums"
                                class="flex items-center w-full p-2 text-[#F1F8FE] transition duration-75 rounded-lg pl-11 group hover:bg-[#293649]">Global</a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
        <ul class="space-y-2 font-medium border-t border-[#F1F8FE] py-2">
            <li>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center p-2 text-[#F1F8FE] rounded-lg hover:bg-[#293649]">
                        <span class="material-symbols-rounded">
                            logout
                        </span>
                        <span class="ml-3">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>

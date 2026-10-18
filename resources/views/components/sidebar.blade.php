<aside class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-[#f0f0f0] bg-white text-slate-700 transition-transform duration-300 lg:translate-x-0 -translate-x-full" id="sidebar">
    <!-- Mantis Brand Header -->
    <div class="flex h-16 items-center justify-between border-b border-[#f0f0f0] px-6">
        <div class="flex items-center gap-3">
            <!-- Mantis Geometric Polygon Logo -->
            <div class="flex h-8 w-8 items-center justify-center shrink-0">
                <svg width="28" height="28" viewBox="0 0 40 40" fill="none">
                    <path d="M20 3L6 11.2V27.8L20 36L34 27.8V11.2L20 3Z" fill="#1677ff" fill-opacity="0.15" stroke="#1677ff" stroke-width="2.5"/>
                    <path d="M20 3L6 11.2L20 19.5L34 11.2L20 3Z" fill="#1677ff" fill-opacity="0.4"/>
                    <path d="M20 19.5V36L34 27.8V11.2L20 19.5Z" fill="#1677ff"/>
                    <path d="M20 19.5V36L6 27.8V11.2L20 19.5Z" fill="#1677ff" fill-opacity="0.75"/>
                </svg>
            </div>
            <div>
                <p class="font-headline text-base font-bold text-slate-900 tracking-tight leading-none">{{ config('app.name', 'Mantis ERP') }}</p>
                <p class="text-[10px] uppercase font-semibold tracking-wider text-[#1677ff] mt-1">Manufacturing System</p>
            </div>
        </div>
        <button onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full'); document.getElementById('sidebar-overlay').classList.toggle('hidden');" class="text-slate-400 hover:text-slate-600 lg:hidden">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Navigation List -->
    <div class="px-3 py-4 flex-1 overflow-y-auto no-scrollbar">
        <!-- SECTION: MAIN MENU -->
        <p class="px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Main Menu</p>
        <nav class="mt-2 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Administration -->
            @can('view-administration')
            <div x-data="{ open: {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.branches.*') || request()->routeIs('admin.warehouses.*') || request()->routeIs('admin.departments.*') || request()->routeIs('admin.company.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Administration</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.users.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Users</a>
                    <a href="{{ route('admin.roles.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">Roles</a>
                    <a href="{{ route('admin.branches.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">Branches</a>
                    <a href="{{ route('admin.warehouses.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.warehouses.*') ? 'active' : '' }}">Warehouses</a>
                    <a href="{{ route('admin.departments.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">Departments</a>
                    <a href="{{ route('admin.company.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.company.*') ? 'active' : '' }}">Company</a>
                </div>
            </div>
            @endcan

            <!-- Product Master -->
            @can('product-view')
            <div x-data="{ open: {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.product-categories.*') || request()->routeIs('admin.units-of-measure.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>Product Master</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.products.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
                    <a href="{{ route('admin.product-categories.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}">Categories</a>
                    <a href="{{ route('admin.units-of-measure.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.units-of-measure.*') ? 'active' : '' }}">Units of Measure</a>
                </div>
            </div>
            @endcan

            <!-- Business Partners -->
            @can('business-partner-view')
            <div x-data="{ open: {{ request()->routeIs('admin.business-partners.*') || request()->routeIs('admin.payment-terms.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Business Partners</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.business-partners.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.business-partners.*') ? 'active' : '' }}">All Partners</a>
                    <a href="{{ route('admin.payment-terms.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.payment-terms.*') ? 'active' : '' }}">Payment Terms</a>
                </div>
            </div>
            @endcan
        </nav>

        <!-- SECTION: OPERATIONS -->
        <p class="px-3 pt-5 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Operations</p>
        <nav class="mt-2 space-y-1">
            <!-- Procurement -->
            @can('procurement-view')
            <div x-data="{ open: {{ request()->routeIs('admin.purchase-requests.*') || request()->routeIs('admin.purchase-orders.*') || request()->routeIs('admin.goods-receipts.*') || request()->routeIs('admin.supplier-returns.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        <span>Procurement</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.purchase-requests.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.purchase-requests.*') ? 'active' : '' }}">Purchase Requests</a>
                    <a href="{{ route('admin.purchase-orders.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.purchase-orders.*') ? 'active' : '' }}">Purchase Orders</a>
                    <a href="{{ route('admin.goods-receipts.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.goods-receipts.*') ? 'active' : '' }}">Goods Receipts</a>
                    <a href="{{ route('admin.supplier-returns.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.supplier-returns.*') ? 'active' : '' }}">Supplier Returns</a>
                </div>
            </div>
            @endcan

            <!-- Inventory -->
            @can('inventory-view')
            <div x-data="{ open: {{ request()->routeIs('admin.inventory.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        <span>Inventory</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.inventory.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.inventory.index') ? 'active' : '' }}">Stock Overview</a>
                    <a href="{{ route('admin.inventory.movements') }}" class="sidebar-sub-link {{ request()->routeIs('admin.inventory.movements') ? 'active' : '' }}">Movements</a>
                    <a href="{{ route('admin.inventory.adjustments.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.inventory.adjustments.*') ? 'active' : '' }}">Adjustments</a>
                    <a href="{{ route('admin.inventory.transfers.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.inventory.transfers.*') ? 'active' : '' }}">Transfers</a>
                </div>
            </div>
            @endcan

            <!-- Manufacturing -->
            @can('manufacturing-order-view')
            <div x-data="{ open: {{ request()->routeIs('admin.manufacturing.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        <span>Manufacturing</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.manufacturing.bom.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.manufacturing.bom.*') ? 'active' : '' }}">Bill of Materials</a>
                    <a href="{{ route('admin.manufacturing.orders.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.manufacturing.orders.*') ? 'active' : '' }}">Manufacturing Orders</a>
                    <a href="{{ route('admin.manufacturing.production.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.manufacturing.production.*') ? 'active' : '' }}">Production</a>
                </div>
            </div>
            @endcan

            <!-- Quality Control -->
            @can('inspection-view')
            <div x-data="{ open: {{ request()->routeIs('admin.quality-control.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Quality Control</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.quality-control.inspections.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.quality-control.inspections.*') ? 'active' : '' }}">Inspections</a>
                    <a href="{{ route('admin.quality-control.non-conformances.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.quality-control.non-conformances.*') ? 'active' : '' }}">Non-Conformances</a>
                    <a href="{{ route('admin.quality-control.corrective-actions.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.quality-control.corrective-actions.*') ? 'active' : '' }}">Corrective Actions</a>
                </div>
            </div>
            @endcan

            <!-- Warehouse -->
            @can('putaway-view')
            <div x-data="{ open: {{ request()->routeIs('admin.warehouse.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span>Warehouse</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.warehouse.putaway.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.warehouse.putaway.*') ? 'active' : '' }}">Put-away</a>
                    <a href="{{ route('admin.warehouse.transfers.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.warehouse.transfers.*') ? 'active' : '' }}">Transfers</a>
                    <a href="{{ route('admin.warehouse.picking.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.warehouse.picking.*') ? 'active' : '' }}">Picking</a>
                    <a href="{{ route('admin.warehouse.dispatch.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.warehouse.dispatch.*') ? 'active' : '' }}">Dispatch</a>
                </div>
            </div>
            @endcan

            <!-- Sales -->
            @can('sales-order-view')
            <div x-data="{ open: {{ request()->routeIs('admin.sales.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Sales</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.sales.sales-orders.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.sales.sales-orders.*') ? 'active' : '' }}">Sales Orders</a>
                    <a href="{{ route('admin.sales.export-orders.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.sales.export-orders.*') ? 'active' : '' }}">Export Orders</a>
                    <a href="{{ route('admin.sales.shipments.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.sales.shipments.*') ? 'active' : '' }}">Shipments</a>
                </div>
            </div>
            @endcan

            <!-- Accounting -->
            @can('accounting-event-view')
            <div x-data="{ open: {{ request()->routeIs('admin.accounting.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span>Accounting</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.accounting.events.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.accounting.events.*') ? 'active' : '' }}">Events</a>
                    <a href="{{ route('admin.accounting.posting-queue.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.accounting.posting-queue.*') ? 'active' : '' }}">Posting Queue</a>
                    <a href="{{ route('admin.accounting.mappings.index') }}" class="sidebar-sub-link {{ request()->routeIs('admin.accounting.mappings.*') ? 'active' : '' }}">Mappings</a>
                </div>
            </div>
            @endcan
        </nav>

        <!-- SECTION: REPORTS -->
        <p class="px-3 pt-5 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Reports</p>
        <nav class="mt-2 space-y-1">
            @can('report-view')
            <div x-data="{ open: {{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sidebar-link w-full flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Reports Center</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" class="space-y-0.5 pl-6 mt-1" style="display: none;">
                    <a href="{{ route('admin.reports.executive') }}" class="sidebar-sub-link {{ request()->routeIs('admin.reports.executive') ? 'active' : '' }}">Executive Dashboard</a>
                    <a href="{{ route('admin.reports.procurement') }}" class="sidebar-sub-link {{ request()->routeIs('admin.reports.procurement') ? 'active' : '' }}">Procurement</a>
                    <a href="{{ route('admin.reports.inventory') }}" class="sidebar-sub-link {{ request()->routeIs('admin.reports.inventory') ? 'active' : '' }}">Inventory</a>
                    <a href="{{ route('admin.reports.manufacturing') }}" class="sidebar-sub-link {{ request()->routeIs('admin.reports.manufacturing') ? 'active' : '' }}">Manufacturing</a>
                    <a href="{{ route('admin.reports.quality') }}" class="sidebar-sub-link {{ request()->routeIs('admin.reports.quality') ? 'active' : '' }}">Quality Control</a>
                    <a href="{{ route('admin.reports.warehouse') }}" class="sidebar-sub-link {{ request()->routeIs('admin.reports.warehouse') ? 'active' : '' }}">Warehouse</a>
                    <a href="{{ route('admin.reports.sales') }}" class="sidebar-sub-link {{ request()->routeIs('admin.reports.sales') ? 'active' : '' }}">Sales</a>
                    <a href="{{ route('admin.reports.accounting') }}" class="sidebar-sub-link {{ request()->routeIs('admin.reports.accounting') ? 'active' : '' }}">Accounting</a>
                </div>
            </div>
            @endcan
        </nav>
    </div>

    <!-- Mantis Bottom User Widget -->
    <div class="mt-auto border-t border-[#f0f0f0] p-4 bg-white">
        <form method="POST" action="{{ route('logout') }}" class="flex items-center justify-between">
            @csrf
            <div class="flex items-center gap-3">
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#1677ff] text-xs font-bold text-white shadow-sm">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}{{ substr(auth()->user()->name ?? '', -1, 1) }}
                </span>
                <div class="text-sm truncate">
                    <p class="font-semibold text-xs text-slate-800 truncate">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-[10px] text-slate-400 truncate">
                        @can('view-administration') Administrator
                        @elsecan('procurement-view') Procurement Officer
                        @elsecan('inventory-view') Warehouse Manager
                        @else Staff
                        @endcan
                    </p>
                </div>
            </div>
            <button type="submit" class="rounded-md p-1.5 text-slate-400 hover:bg-[#fff1f0] hover:text-[#cf1322] transition" title="Sign out">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </button>
        </form>
    </div>
</aside>

<!-- Mobile overlay -->
<div class="fixed inset-0 z-40 bg-slate-900/30 backdrop-blur-sm lg:hidden hidden" id="sidebar-overlay" onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full'); this.classList.toggle('hidden');"></div>

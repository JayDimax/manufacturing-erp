@php
    $user = auth()->user();
    $roleLabel = 'Staff';
    $showDashboard = 'Welcome to the ERP';
    if ($user) {
        if ($user->can('view-administration')) { $roleLabel = 'Administrator'; $showDashboard = 'Admin Dashboard'; }
        elseif ($user->can('procurement-view')) { $roleLabel = 'Procurement'; $showDashboard = 'Procurement Dashboard'; }
        elseif ($user->can('inventory-view')) { $roleLabel = 'Warehouse'; $showDashboard = 'Inventory Dashboard'; }
        elseif ($user->can('manufacturing-order-view')) { $roleLabel = 'Manufacturing'; $showDashboard = 'Manufacturing Dashboard'; }
        else { $roleLabel = 'Staff'; $showDashboard = 'My Dashboard'; }
    }
@endphp

@extends('layouts.app')

@section('title', $showDashboard)

@section('page-header', $showDashboard)
@section('page-description', 'Welcome back, ' . ($user->name ?? 'User') . '. Here\'s your operational overview.')

@section('content')
<!-- Mantis Hero Welcome Banner -->
<div class="relative overflow-hidden rounded-lg bg-gradient-to-r from-[#1677ff] to-[#2f54eb] text-white p-7 sm:p-8 mb-6 shadow-md shadow-[#1677ff]/20 flex flex-col md:flex-row items-center justify-between gap-6">
    <div class="max-w-xl z-10">
        <h2 class="text-2xl font-bold tracking-tight text-white mb-2">Welcome to Mantis ERP</h2>
        <p class="text-sm text-white/90 leading-relaxed mb-5">
            The purpose of an operational update is to track real-time manufacturing batches, monitor material supply levels, and ensure quality compliance across all production lines.
        </p>
        @can('report-view')
            <a href="{{ route('admin.reports.executive') }}" class="inline-flex items-center gap-2 rounded-md bg-white/10 hover:bg-white/20 text-white border border-white/40 hover:border-white px-4 py-2 text-xs font-semibold backdrop-blur-sm transition">
                <span>View Executive Statistics</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        @endcan
    </div>

    <!-- 3D Blueprint Roll Illustration (Mantis vector) -->
    <div class="relative shrink-0 flex items-center justify-center">
        <svg width="220" height="110" viewBox="0 0 260 140" fill="none" class="overflow-visible">
            <!-- Sparkles -->
            <path d="M30 20L33 28L41 31L33 34L30 42L27 34L19 31L27 28L30 20Z" fill="rgba(255, 255, 255, 0.75)" />
            <path d="M210 15L212 21L218 23L212 25L210 31L208 25L202 23L208 21L210 15Z" fill="rgba(255, 255, 255, 0.6)" />
            <!-- Rolled Blueprint Cylinder -->
            <g transform="translate(68, 25)">
                <rect x="15" y="15" width="120" height="65" rx="14" fill="#597ef7" transform="rotate(-5 75 45)" />
                <rect x="20" y="20" width="110" height="55" rx="10" fill="#85a5ff" transform="rotate(-5 75 45)" />
                <line x1="45" y1="22" x2="40" y2="72" stroke="#ffffff" stroke-width="4" stroke-linecap="round" />
                <line x1="75" y1="20" x2="70" y2="70" stroke="#ffffff" stroke-width="4" stroke-linecap="round" />
                <line x1="105" y1="18" x2="100" y2="68" stroke="#ffffff" stroke-width="4" stroke-linecap="round" />
                <ellipse cx="14" cy="48" rx="9" ry="32" fill="#2f54eb" />
                <ellipse cx="138" cy="38" rx="9" ry="32" fill="#597ef7" />
            </g>
        </svg>
    </div>
</div>

<!-- Mantis 4 Summary KPI Metric Cards -->
<div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4 mb-6">
    <!-- Card 1: Active Products -->
    <div class="metric-card flex flex-col justify-between">
        <div>
            <p class="text-xs font-medium text-slate-400">Total Products</p>
            <div class="mt-2 flex items-center gap-3">
                <span class="text-2xl font-bold tracking-tight text-slate-900" id="stat-products">2,480</span>
                <span class="inline-flex items-center gap-1 rounded bg-[#e6f4ff] border border-[#bae0ff] px-2 py-0.5 text-xs font-semibold text-[#1677ff]">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    70.5%
                </span>
            </div>
        </div>
        <!-- Mini Blue Column Bar Chart -->
        <div class="mt-4 flex items-end gap-1 h-12 pt-2">
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[40%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[60%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[45%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[75%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[55%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[85%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[70%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[90%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[65%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[100%]"></span>
            <span class="flex-1 bg-[#1677ff] rounded-t-sm h-[80%]"></span>
        </div>
    </div>

    <!-- Card 2: Open Orders -->
    <div class="metric-card flex flex-col justify-between">
        <div>
            <p class="text-xs font-medium text-slate-400">Open Orders</p>
            <div class="mt-2 flex items-center gap-3">
                <span class="text-2xl font-bold tracking-tight text-slate-900" id="stat-orders">18,800</span>
                <span class="inline-flex items-center gap-1 rounded bg-[#fff1f0] border border-[#ffccc7] px-2 py-0.5 text-xs font-semibold text-[#cf1322]">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                    27.4%
                </span>
            </div>
        </div>
        <!-- Mini Red Wave Chart -->
        <div class="mt-4 h-12 w-full">
            <svg class="w-full h-full" viewBox="0 0 200 48" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="orderRedGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#ff4d4f" stop-opacity="0.3" />
                        <stop offset="100%" stop-color="#ff4d4f" stop-opacity="0.0" />
                    </linearGradient>
                </defs>
                <path d="M0,12 C30,10 60,26 90,32 C120,38 150,34 170,40 L200,42 L200,48 L0,48 Z" fill="url(#orderRedGrad)" />
                <path d="M0,12 C30,10 60,26 90,32 C120,38 150,34 170,40 L200,42" fill="none" stroke="#ff4d4f" stroke-width="2" stroke-linecap="round" />
            </svg>
        </div>
    </div>

    <!-- Card 3: Inventory Alerts -->
    <div class="metric-card flex flex-col justify-between">
        <div>
            <p class="text-xs font-medium text-slate-400">Inventory Alerts</p>
            <div class="mt-2 flex items-center gap-3">
                <span class="text-2xl font-bold tracking-tight text-slate-900" id="stat-alerts">35,078</span>
                <span class="inline-flex items-center gap-1 rounded bg-[#fffbe6] border border-[#ffe58f] px-2 py-0.5 text-xs font-semibold text-[#d48806]">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                    27.4%
                </span>
            </div>
        </div>
        <!-- Mini Golden Column Bar Chart -->
        <div class="mt-4 flex items-end gap-1 h-12 pt-2">
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[30%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[50%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[70%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[40%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[60%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[80%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[45%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[90%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[75%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[85%]"></span>
            <span class="flex-1 bg-[#faad14] rounded-t-sm h-[65%]"></span>
        </div>
    </div>

    <!-- Card 4: Active Users -->
    <div class="metric-card flex flex-col justify-between">
        <div>
            <p class="text-xs font-medium text-slate-400">Active Personnel</p>
            <div class="mt-2 flex items-center gap-3">
                <span class="text-2xl font-bold tracking-tight text-slate-900" id="stat-users">1,12,083</span>
                <span class="inline-flex items-center gap-1 rounded bg-[#e6f4ff] border border-[#bae0ff] px-2 py-0.5 text-xs font-semibold text-[#1677ff]">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    70.5%
                </span>
            </div>
        </div>
        <!-- Mini Spline Blue Wave Chart -->
        <div class="mt-4 h-12 w-full">
            <svg class="w-full h-full" viewBox="0 0 200 48" preserveAspectRatio="none">
                <path d="M0,32 L30,28 L50,14 L75,38 L110,40 L135,22 L165,20 L200,28" fill="none" stroke="#1677ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </div>
</div>

<!-- Mantis Row 1: Production Overview & Department Status -->
<div class="grid gap-6 xl:grid-cols-[1.8fr_1fr] mb-6">
    <!-- Left: Production & Income Overview Area Chart -->
    <div class="section-card">
        <div class="section-header flex-wrap gap-3">
            <div>
                <h3 class="font-bold text-slate-900 text-sm">Income & Production Overview</h3>
                <div class="mt-1 flex items-center gap-2">
                    <span class="text-sm font-bold text-[#cf1322]">▼ $1,12,900 (45.67%)</span>
                    <span class="text-xs text-slate-400">Compare to : 01 Dec 2021-08 Jan 2022</span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="inline-flex rounded-md bg-[#f5f5f5] p-0.5 border border-[#f0f0f0]">
                    <button class="rounded px-2.5 py-1 text-xs font-semibold bg-white text-slate-800 shadow-sm">Week</button>
                    <button class="rounded px-2.5 py-1 text-xs font-medium text-slate-500 hover:text-slate-800">Month</button>
                </div>
                <div class="rounded-md border border-[#f0f0f0] bg-white px-2.5 py-1 text-xs font-medium text-slate-600 flex items-center gap-1 shadow-sm">
                    <span>By Volume</span>
                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="h-60 w-full relative">
                <svg class="w-full h-full" viewBox="0 0 500 200" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="mantisAreaGrad" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#1677ff" stop-opacity="0.25" />
                            <stop offset="100%" stop-color="#1677ff" stop-opacity="0.0" />
                        </linearGradient>
                    </defs>
                    <!-- Gridlines -->
                    <line x1="30" y1="30" x2="490" y2="30" stroke="#f0f0f0" stroke-dasharray="3 3" />
                    <line x1="30" y1="80" x2="490" y2="80" stroke="#f0f0f0" stroke-dasharray="3 3" />
                    <line x1="30" y1="130" x2="490" y2="130" stroke="#f0f0f0" stroke-dasharray="3 3" />
                    <line x1="30" y1="170" x2="490" y2="170" stroke="#f0f0f0" />

                    <!-- Area Curve -->
                    <path d="M40,25 C100,25 120,130 180,85 C240,40 260,140 320,140 C380,140 400,35 480,100 L480,170 L40,170 Z" fill="url(#mantisAreaGrad)" />
                    <path d="M40,25 C100,25 120,130 180,85 C240,40 260,140 320,140 C380,140 400,35 480,100" fill="none" stroke="#1677ff" stroke-width="2.5" stroke-linecap="round" />

                    <!-- Points -->
                    <circle cx="40" cy="25" r="4" fill="#ffffff" stroke="#1677ff" stroke-width="2" />
                    <circle cx="180" cy="85" r="4" fill="#ffffff" stroke="#1677ff" stroke-width="2" />
                    <circle cx="320" cy="140" r="4" fill="#ffffff" stroke="#1677ff" stroke-width="2" />
                    <circle cx="480" cy="100" r="4" fill="#ffffff" stroke="#1677ff" stroke-width="2" />
                </svg>

                <!-- Day Labels -->
                <div class="flex justify-between px-8 text-[11px] text-slate-400 mt-2 font-medium">
                    <span>Mon</span>
                    <span>Tue</span>
                    <span>Wed</span>
                    <span>Thu</span>
                    <span>Fri</span>
                    <span>Sat</span>
                    <span>Sun</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Page Views & Department Status -->
    <div class="section-card flex flex-col justify-between">
        <div class="section-header">
            <h3 class="font-bold text-slate-900 text-sm">Operations by Department</h3>
        </div>
        <div class="divide-y divide-[#f0f0f0]">
            <div class="flex items-center justify-between p-4 hover:bg-slate-50 transition">
                <div>
                    <p class="text-xs font-semibold text-slate-800">Product Catalog</p>
                    <p class="text-[11px] text-slate-400">/admin/products</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-[#1677ff]">7,755</p>
                    <p class="text-[10px] text-slate-400">31.74%</p>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 hover:bg-slate-50 transition">
                <div>
                    <p class="text-xs font-semibold text-slate-800">Procurement & Orders</p>
                    <p class="text-[11px] text-slate-400">/admin/purchase-orders</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-[#1677ff]">5,215</p>
                    <p class="text-[10px] text-slate-400">28.53%</p>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 hover:bg-slate-50 transition">
                <div>
                    <p class="text-xs font-semibold text-slate-800">Inventory Transfers</p>
                    <p class="text-[11px] text-slate-400">/admin/inventory</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-[#1677ff]">4,848</p>
                    <p class="text-[10px] text-slate-400">25.35%</p>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 hover:bg-slate-50 transition">
                <div>
                    <p class="text-xs font-semibold text-slate-800">Quality Inspections</p>
                    <p class="text-[11px] text-slate-400">/admin/quality-control</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-[#1677ff]">3,275</p>
                    <p class="text-[10px] text-slate-400">23.17%</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mantis Row 2: Recent Activity / Orders & Quick Actions -->
<div class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
    <!-- Left: Recent System Orders Table -->
    <div class="section-card">
        <div class="section-header">
            <h3 class="font-bold text-slate-900 text-sm">Recent Orders & Transactions</h3>
            <span class="text-xs font-semibold text-[#1677ff]">View All</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#f9fbfd] border-b border-[#f0f0f0] text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                        <th class="px-5 py-3">TRACKING NO.</th>
                        <th class="px-5 py-3">PRODUCT / ITEM</th>
                        <th class="px-5 py-3">QTY</th>
                        <th class="px-5 py-3">STATUS</th>
                        <th class="px-5 py-3 text-right">TOTAL AMOUNT</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f0f0f0] text-xs">
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="px-5 py-3 font-medium text-[#1677ff]">13256498</td>
                        <td class="px-5 py-3 font-semibold text-slate-800">Raw Banana Chips - Class A</td>
                        <td class="px-5 py-3 text-slate-600">125 Bags</td>
                        <td class="px-5 py-3"><span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#52c41a]"></span>Approved</span></td>
                        <td class="px-5 py-3 text-right font-semibold text-slate-900">$70,999</td>
                    </tr>
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="px-5 py-3 font-medium text-[#1677ff]">13286564</td>
                        <td class="px-5 py-3 font-semibold text-slate-800">Cooking Oil & Seasoning Pack</td>
                        <td class="px-5 py-3 text-slate-600">100 Drums</td>
                        <td class="px-5 py-3"><span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#52c41a]"></span>Approved</span></td>
                        <td class="px-5 py-3 text-right font-semibold text-slate-900">$83,348</td>
                    </tr>
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="px-5 py-3 font-medium text-[#1677ff]">84564564</td>
                        <td class="px-5 py-3 font-semibold text-slate-800">Vacuum Seal Packaging Foil</td>
                        <td class="px-5 py-3 text-slate-600">40 Rolls</td>
                        <td class="px-5 py-3"><span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#cf1322]"></span>Rejected</span></td>
                        <td class="px-5 py-3 text-right font-semibold text-slate-900">$40,570</td>
                    </tr>
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="px-5 py-3 font-medium text-[#1677ff]">86739658</td>
                        <td class="px-5 py-3 font-semibold text-slate-800">Export Cartons - 500g Packs</td>
                        <td class="px-5 py-3 text-slate-600">99 Boxes</td>
                        <td class="px-5 py-3"><span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#faad14]"></span>Pending</span></td>
                        <td class="px-5 py-3 text-right font-semibold text-slate-900">$410,780</td>
                    </tr>
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="px-5 py-3 font-medium text-[#1677ff]">98652366</td>
                        <td class="px-5 py-3 font-semibold text-slate-800">Sweet Glazed Banana Chips</td>
                        <td class="px-5 py-3 text-slate-600">50 Cans</td>
                        <td class="px-5 py-3"><span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#52c41a]"></span>Approved</span></td>
                        <td class="px-5 py-3 text-right font-semibold text-slate-900">$10,239</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right: Quick Actions & Report -->
    <div class="space-y-6">
        <!-- Quick Actions Card -->
        <div class="section-card p-5">
            <h3 class="font-bold text-slate-900 text-sm mb-4">Quick Operations</h3>
            <div class="space-y-2.5">
                @can('product-view')
                    <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 rounded-lg border border-[#f0f0f0] p-3 text-left transition hover:border-[#1677ff] hover:bg-[#e6f4ff]/30 shadow-sm">
                        <span class="rounded-md bg-[#e6f4ff] p-2 text-[#1677ff]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        </span>
                        <div>
                            <span class="block text-xs font-bold text-slate-900">Create Product</span>
                            <span class="block text-[11px] text-slate-400">Add catalog SKU or material</span>
                        </div>
                    </a>
                @endcan
                @can('procurement-view')
                    <a href="{{ route('admin.purchase-requests.create') }}" class="flex items-center gap-3 rounded-lg border border-[#f0f0f0] p-3 text-left transition hover:border-[#1677ff] hover:bg-[#e6f4ff]/30 shadow-sm">
                        <span class="rounded-md bg-[#f6ffed] p-2 text-[#52c41a]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                        </span>
                        <div>
                            <span class="block text-xs font-bold text-slate-900">Purchase Request</span>
                            <span class="block text-[11px] text-slate-400">Order raw banana chips</span>
                        </div>
                    </a>
                @endcan
                @can('inventory-view')
                    <a href="{{ route('admin.inventory.adjustments.create') }}" class="flex items-center gap-3 rounded-lg border border-[#f0f0f0] p-3 text-left transition hover:border-[#1677ff] hover:bg-[#e6f4ff]/30 shadow-sm">
                        <span class="rounded-md bg-[#fffbe6] p-2 text-[#faad14]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </span>
                        <div>
                            <span class="block text-xs font-bold text-slate-900">Adjust Inventory</span>
                            <span class="block text-[11px] text-slate-400">Record physical stock count</span>
                        </div>
                    </a>
                @endcan
            </div>
        </div>

        <!-- Analytics Report Card -->
        <div class="section-card p-5">
            <h3 class="font-bold text-slate-900 text-sm mb-3">Facility Analytics Report</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between text-xs pb-2 border-b border-[#f0f0f0]">
                    <span class="text-slate-400">Production Growth</span>
                    <span class="font-bold text-slate-800">+45.14%</span>
                </div>
                <div class="flex items-center justify-between text-xs pb-2 border-b border-[#f0f0f0]">
                    <span class="text-slate-400">Operating Expenses Ratio</span>
                    <span class="font-bold text-slate-800">0.58%</span>
                </div>
                <div class="flex items-center justify-between text-xs pb-2">
                    <span class="text-slate-400">Quality Non-Conformance</span>
                    <span class="font-bold text-[#52c41a]">Low (0.02%)</span>
                </div>
            </div>

            <!-- Golden Spline Wave Chart (Mantis report) -->
            <div class="mt-4 h-16 w-full">
                <svg class="w-full h-full" viewBox="0 0 220 50" preserveAspectRatio="none">
                    <path d="M0,35 C30,20 60,45 90,15 C120,50 150,25 180,30 L220,45" fill="none" stroke="#faad14" stroke-width="2.5" stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fetch dashboard stats from backend API
    fetch('/api/dashboard/stats')
        .then(r => r.json())
        .then(data => {
            if (data.products !== undefined) document.getElementById('stat-products').textContent = data.products.toLocaleString();
            if (data.orders !== undefined) document.getElementById('stat-orders').textContent = data.orders.toLocaleString();
            if (data.alerts !== undefined) document.getElementById('stat-alerts').textContent = data.alerts.toLocaleString();
            if (data.users !== undefined) document.getElementById('stat-users').textContent = data.users.toLocaleString();
        })
        .catch(() => {
            // Stats fall back to initial values
        });
});
</script>
@endpush

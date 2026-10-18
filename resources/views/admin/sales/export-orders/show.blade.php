@extends('layouts.app')

@section('page-header', $exportOrder->export_order_number)
@section('page-description', 'Export order details')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-card title="Export Order Information" description="Basic details">
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Export Order Number</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $exportOrder->export_order_number }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Status</dt>
                    <dd>
                        <x-badge :status="$exportOrder->status === 'delivered' ? 'active' : ($exportOrder->status === 'cancelled' ? 'inactive' : ($exportOrder->status === 'planned' ? 'info' : 'in-progress'))">
                            {{ ucfirst(str_replace('_', ' ', $exportOrder->status)) }}
                        </x-badge>
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Customer</dt>
                    <dd class="text-sm text-gray-700">{{ $exportOrder->customer->partner_name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Destination Country</dt>
                    <dd class="text-sm text-gray-700">{{ $exportOrder->destination_country }}</dd>
                </div>
            </dl>
        </x-card>

        <x-card title="Shipping Details">
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Port of Loading</dt>
                    <dd class="text-sm text-gray-700">{{ $exportOrder->port_of_loading ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Port of Destination</dt>
                    <dd class="text-sm text-gray-700">{{ $exportOrder->port_of_destination ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Vessel</dt>
                    <dd class="text-sm text-gray-700">{{ $exportOrder->vessel ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">ETD / ETA</dt>
                    <dd class="text-sm text-gray-700">
                        {{ $exportOrder->etd ? $exportOrder->etd->format('Y-m-d') : '-' }} / 
                        {{ $exportOrder->eta ? $exportOrder->eta->format('Y-m-d') : '-' }}
                    </dd>
                </div>
            </dl>
        </x-card>

        <x-card title="Container & Tracking">
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Container Number</dt>
                    <dd class="text-sm text-gray-700">{{ $exportOrder->container_number ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Seal Number</dt>
                    <dd class="text-sm text-gray-700">{{ $exportOrder->seal_number ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Approved By</dt>
                    <dd class="text-sm text-gray-700">{{ $exportOrder->approver->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Notes</dt>
                    <dd class="text-sm text-gray-700">{{ $exportOrder->notes ?? '-' }}</dd>
                </div>
            </dl>
        </x-card>
    </div>

    <!-- Items Table -->
    <x-card title="Export Order Items">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-500">Product</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-500">Sales Order</th>
                        <th class="px-4 py-2 text-right font-medium text-gray-500">Quantity</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($exportOrder->items as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->product->product_name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->salesOrder->sales_order_number ?? '-' }}</td>
                            <td class="px-4 py-2 text-right font-medium">{{ number_format($item->quantity, 4) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-gray-500">No items found for this export order.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <div class="flex items-center justify-between">
        <x-button variant="secondary" href="{{ route('admin.sales.export-orders.index') }}">Back to Export Orders</x-button>
        <div class="flex items-center space-x-2">
            <x-button variant="secondary" href="{{ route('admin.sales.export-orders.edit', $exportOrder) }}">Edit Order</x-button>
        </div>
    </div>
</div>
@endsection

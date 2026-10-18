@extends('layouts.app')

@section('page-header', 'Create Goods Receipt')
@section('page-description', 'Record incoming goods from a supplier delivery')

@section('content')
<div class="max-w-5xl">
    <x-card>
        <form action="{{ route('admin.goods-receipts.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="GR Number" name="goods_receipt_number" id="goods_receipt_number" value="{{ old('goods_receipt_number') }}" help="Leave empty for auto-generation." />
                <x-select label="Purchase Order" name="purchase_order_id" id="purchase_order_id" :required="true" :options="$purchaseOrders->mapWithKeys(fn($po) => [$po->id => $po->purchase_order_number . ' - ' . ($po->supplier->partner_name ?? '')])->toArray()" :selected="old('purchase_order_id')" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-input label="Delivery Receipt #" name="delivery_receipt_number" id="delivery_receipt_number" value="{{ old('delivery_receipt_number') }}" />
                <x-input label="Supplier Invoice #" name="supplier_invoice_number" id="supplier_invoice_number" value="{{ old('supplier_invoice_number') }}" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-input label="Date Received" name="date_received" id="date_received" type="date" :required="true" value="{{ old('date_received', date('Y-m-d')) }}" />
                <x-select label="Warehouse" name="warehouse_id" id="warehouse_id" :required="true" :options="$warehouses->pluck('warehouse_name', 'id')->toArray()" :selected="old('warehouse_id')" />
            </div>

            <div class="mt-4">
                <x-input label="Received By" name="received_by" id="received_by" :required="true" value="{{ old('received_by', auth()->user()->name ?? '') }}" />
            </div>

            <div class="mt-4">
                <x-textarea label="Remarks" name="remarks" id="remarks">{{ old('remarks') }}</x-textarea>
            </div>

            <!-- Items Section -->
            <div class="mt-6 border-t border-gray-200 pt-6">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Received Items *</h4>
                    <button type="button" onclick="addItem()" class="inline-flex items-center text-xs font-semibold text-blue-600 hover:text-blue-800">
                        + Add Item
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">Product *</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">UOM *</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500 w-24">Ordered *</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500 w-24">Received *</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500 w-28">Unit Cost *</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500 w-28">Batch #</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500 w-32">Expiry Date</th>
                                <th class="px-3 py-2 text-center w-12"></th>
                            </tr>
                        </thead>
                        <tbody id="items-tbody" class="divide-y divide-gray-100">
                            <tr class="item-row">
                                <td class="px-3 py-2">
                                    <select name="items[0][product_id]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required>
                                        <option value="">Select Product</option>
                                        @foreach($products as $prod)
                                            <option value="{{ $prod->id }}">{{ $prod->product_code }} - {{ $prod->product_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-3 py-2">
                                    <select name="items[0][uom_id]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required>
                                        <option value="">Select UOM</option>
                                        @foreach($uoms as $uom)
                                            <option value="{{ $uom->id }}">{{ $uom->uom_code }} ({{ $uom->uom_name }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-3 py-2">
                                    <input type="number" step="0.0001" min="0" name="items[0][quantity_ordered]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required placeholder="0.00" value="1">
                                </td>
                                <td class="px-3 py-2">
                                    <input type="number" step="0.0001" min="0.0001" name="items[0][quantity_received]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required placeholder="0.00" value="1">
                                </td>
                                <td class="px-3 py-2">
                                    <input type="number" step="0.01" min="0" name="items[0][unit_cost]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required placeholder="0.00" value="0.00">
                                </td>
                                <td class="px-3 py-2">
                                    <input type="text" name="items[0][batch_number]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Batch">
                                </td>
                                <td class="px-3 py-2">
                                    <input type="date" name="items[0][expiry_date]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700 font-semibold">✕</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3 border-t border-gray-200 pt-4">
                <x-button variant="secondary" href="{{ route('admin.goods-receipts.index') }}">Cancel</x-button>
                <x-button variant="primary" type="submit">Save Goods Receipt</x-button>
            </div>
        </form>
    </x-card>
</div>

@push('scripts')
<script>
let itemIndex = 1;
function addItem() {
    const tbody = document.getElementById('items-tbody');
    const tr = document.createElement('tr');
    tr.className = 'item-row';
    tr.innerHTML = `
        <td class="px-3 py-2">
            <select name="items[${itemIndex}][product_id]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required>
                <option value="">Select Product</option>
                @foreach($products as $prod)
                    <option value="{{ $prod->id }}">{{ $prod->product_code }} - {{ $prod->product_name }}</option>
                @endforeach
            </select>
        </td>
        <td class="px-3 py-2">
            <select name="items[${itemIndex}][uom_id]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required>
                <option value="">Select UOM</option>
                @foreach($uoms as $uom)
                    <option value="{{ $uom->id }}">{{ $uom->uom_code }} ({{ $uom->uom_name }})</option>
                @endforeach
            </select>
        </td>
        <td class="px-3 py-2">
            <input type="number" step="0.0001" min="0" name="items[${itemIndex}][quantity_ordered]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required placeholder="0.00" value="1">
        </td>
        <td class="px-3 py-2">
            <input type="number" step="0.0001" min="0.0001" name="items[${itemIndex}][quantity_received]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required placeholder="0.00" value="1">
        </td>
        <td class="px-3 py-2">
            <input type="number" step="0.01" min="0" name="items[${itemIndex}][unit_cost]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required placeholder="0.00" value="0.00">
        </td>
        <td class="px-3 py-2">
            <input type="text" name="items[${itemIndex}][batch_number]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Batch">
        </td>
        <td class="px-3 py-2">
            <input type="date" name="items[${itemIndex}][expiry_date]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500">
        </td>
        <td class="px-3 py-2 text-center">
            <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700 font-semibold">✕</button>
        </td>
    `;
    tbody.appendChild(tr);
    itemIndex++;
}

function removeItem(btn) {
    const rows = document.querySelectorAll('#items-tbody .item-row');
    if (rows.length > 1) {
        btn.closest('tr').remove();
    } else {
        alert('At least one item is required.');
    }
}
</script>
@endpush
@endsection

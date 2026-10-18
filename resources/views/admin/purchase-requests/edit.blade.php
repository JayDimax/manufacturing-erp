@extends('layouts.app')

@section('page-header', 'Edit Purchase Request')
@section('page-description', 'Update purchase request information')

@section('content')
<div class="max-w-4xl">
    <x-card>
        <form action="{{ route('admin.purchase-requests.update', $purchaseRequest) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="Request Number" name="request_number" id="request_number" :required="true" value="{{ old('request_number', $purchaseRequest->request_number) }}" />
                <x-input label="Request Date" name="request_date" id="request_date" type="date" :required="true" value="{{ old('request_date', $purchaseRequest->request_date->format('Y-m-d')) }}" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-select label="Department" name="department_id" id="department_id" :required="true" :options="$departments->pluck('department_name', 'id')->toArray()" :selected="old('department_id', $purchaseRequest->department_id)" />
                <x-select label="Priority" name="priority" id="priority" :required="true" :options="$priorities" :selected="old('priority', $purchaseRequest->priority)" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-input label="Required Date" name="required_date" id="required_date" type="date" value="{{ old('required_date', $purchaseRequest->required_date?->format('Y-m-d')) }}" />
                <x-input label="Requested By" name="requested_by" id="requested_by" :required="true" value="{{ old('requested_by', $purchaseRequest->requested_by) }}" />
            </div>

            <div class="mt-4">
                <x-textarea label="Remarks" name="remarks" id="remarks">{{ old('remarks', $purchaseRequest->remarks) }}</x-textarea>
            </div>

            <!-- Items Section -->
            <div class="mt-6 border-t border-gray-200 pt-6">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Requested Items *</h4>
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
                                <th class="px-3 py-2 text-left font-medium text-gray-500 w-32">Quantity *</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">Remarks</th>
                                <th class="px-3 py-2 text-center w-16"></th>
                            </tr>
                        </thead>
                        <tbody id="items-tbody" class="divide-y divide-gray-100">
                            @forelse($purchaseRequest->items as $idx => $item)
                                <tr class="item-row">
                                    <td class="px-3 py-2">
                                        <select name="items[{{ $idx }}][product_id]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required>
                                            <option value="">Select Product</option>
                                            @foreach($products as $prod)
                                                <option value="{{ $prod->id }}" {{ $item->product_id == $prod->id ? 'selected' : '' }}>{{ $prod->product_code }} - {{ $prod->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-3 py-2">
                                        <select name="items[{{ $idx }}][uom_id]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required>
                                            <option value="">Select UOM</option>
                                            @foreach($uoms as $uom)
                                                <option value="{{ $uom->id }}" {{ $item->uom_id == $uom->id ? 'selected' : '' }}>{{ $uom->uom_code }} ({{ $uom->uom_name }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-3 py-2">
                                        <input type="number" step="0.0001" min="0.0001" name="items[{{ $idx }}][quantity]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ $item->quantity }}">
                                    </td>
                                    <td class="px-3 py-2">
                                        <input type="text" name="items[{{ $idx }}][remarks]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" value="{{ $item->remarks }}">
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700 font-semibold">✕</button>
                                    </td>
                                </tr>
                            @empty
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
                                        <input type="number" step="0.0001" min="0.0001" name="items[0][quantity]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required value="1">
                                    </td>
                                    <td class="px-3 py-2">
                                        <input type="text" name="items[0][remarks]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700 font-semibold">✕</button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3 border-t border-gray-200 pt-4">
                <x-button variant="secondary" href="{{ route('admin.purchase-requests.index') }}">Cancel</x-button>
                <x-button variant="primary" type="submit">Update Purchase Request</x-button>
            </div>
        </form>
    </x-card>
</div>

@push('scripts')
<script>
let itemIndex = {{ max(1, count($purchaseRequest->items)) }};
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
            <input type="number" step="0.0001" min="0.0001" name="items[${itemIndex}][quantity]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" required value="1">
        </td>
        <td class="px-3 py-2">
            <input type="text" name="items[${itemIndex}][remarks]" class="w-full rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Optional notes">
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

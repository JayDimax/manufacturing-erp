@extends('layouts.app')

@section('page-header', $packingList->packing_list_number)
@section('page-description', 'Packing list details')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-card title="Packing List Information" description="Document details">
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Packing List Number</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $packingList->packing_list_number }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Export Order</dt>
                    <dd class="text-sm text-gray-700">
                        @if($packingList->exportOrder)
                            <a href="{{ route('admin.sales.export-orders.show', $packingList->exportOrder) }}" class="text-blue-600 hover:underline">
                                {{ $packingList->exportOrder->export_order_number }}
                            </a>
                        @else
                            -
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Product</dt>
                    <dd class="text-sm text-gray-700">{{ $packingList->product->product_name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Batch Number</dt>
                    <dd class="text-sm text-gray-700">{{ $packingList->batch_number ?? '-' }}</dd>
                </div>
            </dl>
        </x-card>

        <x-card title="Package & Weight Details" description="Measurements">
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Quantity</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ number_format($packingList->quantity, 4) }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Number of Cartons</dt>
                    <dd class="text-sm text-gray-700">{{ $packingList->number_of_cartons ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Net Weight</dt>
                    <dd class="text-sm text-gray-700">{{ $packingList->net_weight ? number_format($packingList->net_weight, 2) . ' kg' : '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Gross Weight</dt>
                    <dd class="text-sm text-gray-700">{{ $packingList->gross_weight ? number_format($packingList->gross_weight, 2) . ' kg' : '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase">Remarks</dt>
                    <dd class="text-sm text-gray-700">{{ $packingList->remarks ?? '-' }}</dd>
                </div>
            </dl>
        </x-card>
    </div>

    <div class="flex items-center justify-between">
        <x-button variant="secondary" href="{{ route('admin.sales.shipments.index') }}">Back to Shipments</x-button>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('page-header', 'Edit Warehouse')
@section('page-description', 'Update warehouse information')

@section('content')
<div class="max-w-2xl mx-auto">
    <x-card>
        <form action="{{ route('admin.warehouses.update', $warehouse) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <x-input
                    label="Warehouse Name"
                    name="warehouse_name"
                    :value="old('warehouse_name', $warehouse->warehouse_name)"
                    required
                    placeholder="e.g. Raw Material Warehouse"
                />

                <x-input
                    label="Warehouse Code"
                    name="warehouse_code"
                    :value="old('warehouse_code', $warehouse->warehouse_code)"
                    placeholder="Auto-generated if empty"
                />

                <x-select
                    label="Warehouse Type"
                    name="warehouse_type"
                    :selected="old('warehouse_type', $warehouse->warehouse_type)"
                    required
                    :options="[
                        'raw_material' => 'Raw Material',
                        'packaging' => 'Packaging',
                        'production' => 'Production',
                        'finished_goods' => 'Finished Goods',
                        'transit' => 'Transit',
                    ]"
                />

                <x-select
                    label="Branch"
                    name="branch_id"
                    :selected="old('branch_id', $warehouse->branch_id)"
                    required
                    :options="$branches->pluck('branch_name', 'id')"
                />

                <x-textarea
                    label="Address"
                    name="address"
                    :value="old('address', $warehouse->address)"
                    rows="3"
                >{{ old('address', $warehouse->address) }}</x-textarea>

                <x-checkbox
                    label="Active"
                    name="is_active"
                    :checked="old('is_active', $warehouse->is_active)"
                />
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3">
                <x-button variant="secondary" href="{{ route('admin.warehouses.index') }}">Cancel</x-button>
                <x-button variant="primary" type="submit">Update Warehouse</x-button>
            </div>
        </form>
    </x-card>
</div>
@endsection

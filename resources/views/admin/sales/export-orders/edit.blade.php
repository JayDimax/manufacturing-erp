@extends('layouts.app')

@section('page-header', 'Edit Export Order')
@section('page-description', 'Update export shipment order details')

@section('content')
<div class="max-w-4xl">
    <x-card>
        <form action="{{ route('admin.sales.export-orders.update', $exportOrder) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="Export Order Number" name="export_order_number" id="export_order_number" :required="true" value="{{ old('export_order_number', $exportOrder->export_order_number) }}" />
                <x-select label="Customer" name="customer_id" id="customer_id" :required="true" :options="$customers->pluck('partner_name', 'id')->toArray()" :selected="old('customer_id', $exportOrder->customer_id)" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-input label="Destination Country" name="destination_country" id="destination_country" :required="true" value="{{ old('destination_country', $exportOrder->destination_country) }}" />
                <x-input label="Port of Loading" name="port_of_loading" id="port_of_loading" value="{{ old('port_of_loading', $exportOrder->port_of_loading) }}" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-input label="Port of Destination" name="port_of_destination" id="port_of_destination" value="{{ old('port_of_destination', $exportOrder->port_of_destination) }}" />
                <x-input label="Vessel" name="vessel" id="vessel" value="{{ old('vessel', $exportOrder->vessel) }}" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-input label="ETD (Estimated Departure)" name="etd" id="etd" type="date" value="{{ old('etd', $exportOrder->etd ? $exportOrder->etd->format('Y-m-d') : '') }}" />
                <x-input label="ETA (Estimated Arrival)" name="eta" id="eta" type="date" value="{{ old('eta', $exportOrder->eta ? $exportOrder->eta->format('Y-m-d') : '') }}" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-input label="Container Number" name="container_number" id="container_number" value="{{ old('container_number', $exportOrder->container_number) }}" />
                <x-input label="Seal Number" name="seal_number" id="seal_number" value="{{ old('seal_number', $exportOrder->seal_number) }}" />
            </div>

            <div class="mt-4">
                <x-textarea label="Notes" name="notes" id="notes">{{ old('notes', $exportOrder->notes) }}</x-textarea>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3">
                <x-button variant="secondary" href="{{ route('admin.sales.export-orders.index') }}">Cancel</x-button>
                <x-button variant="primary" type="submit">Update Export Order</x-button>
            </div>
        </form>
    </x-card>
</div>
@endsection

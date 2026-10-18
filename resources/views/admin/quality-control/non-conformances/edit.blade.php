@extends('layouts.app')

@section('page-header', 'Edit Non-Conformance')
@section('page-description', 'Update quality non-conformance record')

@section('content')
<div class="max-w-3xl">
    <x-card>
        <form action="{{ route('admin.quality-control.non-conformances.update', $nonConformance) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if(isset($inspections) && $inspections->count() > 0)
                    <x-select label="Quality Inspection" name="quality_inspection_id" id="quality_inspection_id" :required="true" :options="$inspections->mapWithKeys(fn($i) => [$i->id => $i->inspection_number . ' (' . ($i->product->product_name ?? 'N/A') . ')'])->toArray()" :selected="old('quality_inspection_id', $nonConformance->quality_inspection_id)" />
                @else
                    <x-input label="Quality Inspection ID" name="quality_inspection_id" id="quality_inspection_id" type="number" :required="true" :value="old('quality_inspection_id', $nonConformance->quality_inspection_id)" />
                @endif
                <x-select label="Defect Type" name="defect_type_id" id="defect_type_id" :options="$defectTypes->pluck('name', 'id')->toArray()" :selected="old('defect_type_id', $nonConformance->defect_type_id)" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-input label="Defect Type Name" name="defect_type" id="defect_type" :required="true" value="{{ old('defect_type', $nonConformance->defect_type) }}" />
                <x-select label="Severity" name="severity" id="severity" :required="true" :options="$severities" :selected="old('severity', $nonConformance->severity)" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <x-input label="Quantity Affected" name="quantity_affected" id="quantity_affected" type="number" step="0.0001" :required="true" value="{{ old('quantity_affected', $nonConformance->quantity_affected) }}" />
                <x-input label="Responsible Department" name="responsible_department" id="responsible_department" value="{{ old('responsible_department', $nonConformance->responsible_department) }}" />
            </div>

            <div class="mt-4">
                <x-textarea label="Description" name="description" id="description" :required="true">{{ old('description', $nonConformance->description) }}</x-textarea>
            </div>

            <div class="mt-4">
                <x-textarea label="Root Cause" name="root_cause" id="root_cause">{{ old('root_cause', $nonConformance->root_cause) }}</x-textarea>
            </div>

            <div class="mt-4">
                <x-textarea label="Recommended Action" name="recommended_action" id="recommended_action">{{ old('recommended_action', $nonConformance->recommended_action) }}</x-textarea>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3">
                <x-button variant="secondary" href="{{ route('admin.quality-control.non-conformances.index') }}">Cancel</x-button>
                <x-button variant="primary" type="submit">Update Non-Conformance</x-button>
            </div>
        </form>
    </x-card>
</div>
@endsection

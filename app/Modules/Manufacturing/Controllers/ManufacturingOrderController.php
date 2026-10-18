<?php

namespace Modules\Manufacturing\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Administration\Services\WarehouseService;
use Modules\Manufacturing\Models\ManufacturingOrder;
use Modules\Manufacturing\Requests\StoreManufacturingOrderRequest;
use Modules\Manufacturing\Requests\UpdateManufacturingOrderRequest;
use Modules\Manufacturing\Services\BillOfMaterialService;
use Modules\Manufacturing\Services\ManufacturingOrderService;
use Modules\ProductMaster\Services\ProductService;
use Modules\ProductMaster\Services\UnitOfMeasureService;

class ManufacturingOrderController extends Controller
{
    public function __construct(
        protected ManufacturingOrderService $moService,
        protected BillOfMaterialService $bomService,
        protected ProductService $productService,
        protected UnitOfMeasureService $uomService,
        protected WarehouseService $warehouseService,
    ) {}

    public function index(): View
    {
        $orders = $this->moService->getPaginated();

        return view('admin.manufacturing.orders.index', compact('orders'));
    }

    public function create(): View
    {
        $products = $this->productService->getAll();
        $warehouses = $this->warehouseService->getAll();
        $uoms = $this->uomService->getAll();
        $priorities = [
            'low' => 'Low',
            'normal' => 'Normal',
            'high' => 'High',
            'urgent' => 'Urgent',
        ];

        return view('admin.manufacturing.orders.create', compact('products', 'warehouses', 'uoms', 'priorities'));
    }

    public function store(StoreManufacturingOrderRequest $request): RedirectResponse
    {
        $this->moService->create($request->validated());

        return redirect()->route('admin.manufacturing.orders.index')
            ->with('success', 'Manufacturing Order created successfully.');
    }

    public function show(ManufacturingOrder $manufacturingOrder): View
    {
        $manufacturingOrder->load([
            'product', 'billOfMaterial', 'uom', 'warehouse',
            'items.product', 'items.uom',
            'materialIssues', 'productionOutputs', 'wasteRecords',
        ]);

        return view('admin.manufacturing.orders.show', compact('manufacturingOrder'));
    }

    public function edit(ManufacturingOrder $manufacturingOrder): View
    {
        $products = $this->productService->getAll();
        $warehouses = $this->warehouseService->getAll();
        $uoms = $this->uomService->getAll();
        $boms = $this->bomService->findById($manufacturingOrder->bill_of_material_id);
        $priorities = [
            'low' => 'Low',
            'normal' => 'Normal',
            'high' => 'High',
            'urgent' => 'Urgent',
        ];

        return view('admin.manufacturing.orders.edit', compact('manufacturingOrder', 'products', 'warehouses', 'uoms', 'priorities'));
    }

    public function update(UpdateManufacturingOrderRequest $request, ManufacturingOrder $manufacturingOrder): RedirectResponse
    {
        $this->moService->update($manufacturingOrder, $request->validated());

        return redirect()->route('admin.manufacturing.orders.index')
            ->with('success', 'Manufacturing Order updated successfully.');
    }

    public function destroy(ManufacturingOrder $manufacturingOrder): RedirectResponse
    {
        $this->moService->delete($manufacturingOrder);

        return redirect()->route('admin.manufacturing.orders.index')
            ->with('success', 'Manufacturing Order deleted successfully.');
    }

    public function release(ManufacturingOrder $manufacturingOrder): RedirectResponse
    {
        $this->moService->release($manufacturingOrder);

        return redirect()->route('admin.manufacturing.orders.index')
            ->with('success', 'Manufacturing Order released and materials reserved.');
    }

    public function start(ManufacturingOrder $manufacturingOrder): RedirectResponse
    {
        $this->moService->startProduction($manufacturingOrder);

        return redirect()->route('admin.manufacturing.orders.index')
            ->with('success', 'Production started successfully.');
    }

    public function complete(ManufacturingOrder $manufacturingOrder): RedirectResponse
    {
        $this->moService->complete($manufacturingOrder);

        return redirect()->route('admin.manufacturing.orders.index')
            ->with('success', 'Production completed. Pending quality inspection.');
    }

    public function close(ManufacturingOrder $manufacturingOrder): RedirectResponse
    {
        $this->moService->close($manufacturingOrder);

        return redirect()->route('admin.manufacturing.orders.index')
            ->with('success', 'Manufacturing Order closed successfully.');
    }

    public function cancel(ManufacturingOrder $manufacturingOrder): RedirectResponse
    {
        $this->moService->cancel($manufacturingOrder);

        return redirect()->route('admin.manufacturing.orders.index')
            ->with('success', 'Manufacturing Order cancelled successfully.');
    }

    public function getBomForProduct(int $productId)
    {
        $bom = $this->bomService->findActiveByProduct($productId);

        return response()->json($bom ? $bom->load('items.product', 'items.uom') : null);
    }
}

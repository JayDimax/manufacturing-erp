<?php

namespace Modules\Procurement\Services;

use App\Services\AuditService;
use App\Services\NumberSeriesService;
use Modules\Procurement\Models\PurchaseOrder;
use Modules\Procurement\Repositories\PurchaseOrderRepository;
use Modules\Procurement\Repositories\PurchaseOrderItemRepository;

class PurchaseOrderService
{
    public function __construct(
        protected PurchaseOrderRepository $purchaseOrderRepository,
        protected PurchaseOrderItemRepository $purchaseOrderItemRepository,
        protected NumberSeriesService $numberSeriesService,
        protected AuditService $auditService,
    ) {}

    public function getPaginated(int $perPage = 15)
    {
        return $this->purchaseOrderRepository->paginate($perPage);
    }

    public function findById(int $id): ?PurchaseOrder
    {
        return $this->purchaseOrderRepository->find($id);
    }

    public function create(array $data): PurchaseOrder
    {
        if (!isset($data['purchase_order_number'])) {
            $data['purchase_order_number'] = $this->numberSeriesService->generateNext('PO');
        }
        if (!isset($data['status'])) {
            $data['status'] = 'draft';
        }

        $items = $data['items'] ?? [];
        unset($data['items']);

        $purchaseOrder = $this->purchaseOrderRepository->create($data);

        foreach ($items as $item) {
            $item['purchase_order_id'] = $purchaseOrder->id;
            if (!isset($item['total_cost'])) {
                $item['total_cost'] = ($item['quantity_ordered'] ?? 0) * ($item['unit_cost'] ?? 0);
            }
            $this->purchaseOrderItemRepository->create($item);
        }

        $this->auditService->logCreate('procurement', $purchaseOrder->purchase_order_number, $data);

        return $purchaseOrder;
    }

    public function update(PurchaseOrder $purchaseOrder, array $data): bool
    {
        $items = $data['items'] ?? null;
        unset($data['items']);

        $oldValues = $purchaseOrder->toArray();
        $result = $this->purchaseOrderRepository->update($purchaseOrder, $data);

        if ($items !== null) {
            $purchaseOrder->items()->delete();
            foreach ($items as $item) {
                $item['purchase_order_id'] = $purchaseOrder->id;
                if (!isset($item['total_cost'])) {
                    $item['total_cost'] = ($item['quantity_ordered'] ?? 0) * ($item['unit_cost'] ?? 0);
                }
                $this->purchaseOrderItemRepository->create($item);
            }
        }

        if ($result) {
            $this->auditService->logUpdate('procurement', $purchaseOrder->purchase_order_number, $oldValues, $data);
        }

        return $result;
    }

    public function delete(PurchaseOrder $purchaseOrder): bool
    {
        $this->auditService->logDelete('procurement', $purchaseOrder->purchase_order_number, $purchaseOrder->toArray());
        return $this->purchaseOrderRepository->delete($purchaseOrder);
    }

    public function approve(PurchaseOrder $purchaseOrder): bool
    {
        $purchaseOrder->status = 'approved';
        $result = $purchaseOrder->save();

        if ($result) {
            $this->auditService->logApprove('procurement', $purchaseOrder->purchase_order_number);
        }

        return $result;
    }

    public function send(PurchaseOrder $purchaseOrder): bool
    {
        $purchaseOrder->status = 'sent';
        $result = $purchaseOrder->save();

        if ($result) {
            $this->auditService->logSubmit('procurement', $purchaseOrder->purchase_order_number);
        }

        return $result;
    }

    public function close(PurchaseOrder $purchaseOrder): bool
    {
        $purchaseOrder->status = 'closed';
        $result = $purchaseOrder->save();

        if ($result) {
            $this->auditService->logComplete('procurement', $purchaseOrder->purchase_order_number);
        }

        return $result;
    }

    public function cancel(PurchaseOrder $purchaseOrder): bool
    {
        $purchaseOrder->status = 'cancelled';
        $result = $purchaseOrder->save();

        if ($result) {
            $this->auditService->logCancel('procurement', $purchaseOrder->purchase_order_number);
        }

        return $result;
    }

    public function findOpen()
    {
        return $this->purchaseOrderRepository->findOpen();
    }

    public function findByStatus(string $status)
    {
        return $this->purchaseOrderRepository->findByStatus($status);
    }
}


<?php

namespace Modules\Procurement\Services;

use App\Services\AuditService;
use App\Services\NumberSeriesService;
use Modules\Procurement\Models\PurchaseRequest;
use Modules\Procurement\Repositories\PurchaseRequestItemRepository;
use Modules\Procurement\Repositories\PurchaseRequestRepository;

class PurchaseRequestService
{
    public function __construct(
        protected PurchaseRequestRepository $purchaseRequestRepository,
        protected PurchaseRequestItemRepository $purchaseRequestItemRepository,
        protected NumberSeriesService $numberSeriesService,
        protected AuditService $auditService,
    ) {}

    public function getPaginated(int $perPage = 15)
    {
        return $this->purchaseRequestRepository->paginate($perPage);
    }

    public function findById(int $id): ?PurchaseRequest
    {
        return $this->purchaseRequestRepository->find($id);
    }

    public function create(array $data): PurchaseRequest
    {
        if (! isset($data['request_number'])) {
            $data['request_number'] = $this->numberSeriesService->generateNext('PR');
        }
        if (! isset($data['status'])) {
            $data['status'] = 'draft';
        }
        if (! isset($data['request_date'])) {
            $data['request_date'] = now();
        }
        if (! isset($data['requested_by'])) {
            $data['requested_by'] = auth()->user()->name ?? 'System';
        }

        $items = $data['items'] ?? [];
        unset($data['items']);

        $purchaseRequest = $this->purchaseRequestRepository->create($data);

        foreach ($items as $item) {
            $item['purchase_request_id'] = $purchaseRequest->id;
            if (! isset($item['quantity']) && isset($item['quantity_requested'])) {
                $item['quantity'] = $item['quantity_requested'];
            }
            $this->purchaseRequestItemRepository->create($item);
        }

        $this->auditService->logCreate('procurement', $purchaseRequest->request_number, $data);

        return $purchaseRequest;
    }

    public function update(PurchaseRequest $purchaseRequest, array $data): bool
    {
        $items = $data['items'] ?? null;
        unset($data['items']);

        $oldValues = $purchaseRequest->toArray();
        $result = $this->purchaseRequestRepository->update($purchaseRequest, $data);

        if ($items !== null) {
            $purchaseRequest->items()->delete();
            foreach ($items as $item) {
                $item['purchase_request_id'] = $purchaseRequest->id;
                if (! isset($item['quantity']) && isset($item['quantity_requested'])) {
                    $item['quantity'] = $item['quantity_requested'];
                }
                $this->purchaseRequestItemRepository->create($item);
            }
        }

        if ($result) {
            $this->auditService->logUpdate('procurement', $purchaseRequest->request_number, $oldValues, $data);
        }

        return $result;
    }

    public function delete(PurchaseRequest $purchaseRequest): bool
    {
        $this->auditService->logDelete('procurement', $purchaseRequest->request_number, $purchaseRequest->toArray());

        return $this->purchaseRequestRepository->delete($purchaseRequest);
    }

    public function submit(PurchaseRequest $purchaseRequest): bool
    {
        $purchaseRequest->status = 'submitted';
        $result = $purchaseRequest->save();

        if ($result) {
            $this->auditService->logSubmit('procurement', $purchaseRequest->request_number);
        }

        return $result;
    }

    public function approve(PurchaseRequest $purchaseRequest): bool
    {
        $purchaseRequest->status = 'approved';
        $result = $purchaseRequest->save();

        if ($result) {
            $this->auditService->logApprove('procurement', $purchaseRequest->request_number);
        }

        return $result;
    }

    public function reject(PurchaseRequest $purchaseRequest): bool
    {
        $purchaseRequest->status = 'rejected';
        $result = $purchaseRequest->save();

        if ($result) {
            $this->auditService->logReject('procurement', $purchaseRequest->request_number);
        }

        return $result;
    }

    public function cancel(PurchaseRequest $purchaseRequest): bool
    {
        $purchaseRequest->status = 'cancelled';
        $result = $purchaseRequest->save();

        if ($result) {
            $this->auditService->logCancel('procurement', $purchaseRequest->request_number);
        }

        return $result;
    }

    public function getPendingApproval()
    {
        return $this->purchaseRequestRepository->findPendingApproval();
    }

    public function findByStatus(string $status)
    {
        return $this->purchaseRequestRepository->findByStatus($status);
    }
}

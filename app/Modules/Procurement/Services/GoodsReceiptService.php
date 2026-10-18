<?php

namespace Modules\Procurement\Services;

use App\Services\AuditService;
use App\Services\NumberSeriesService;
use Modules\Procurement\Models\GoodsReceipt;
use Modules\Procurement\Models\PurchaseOrderItem;
use Modules\Procurement\Repositories\GoodsReceiptItemRepository;
use Modules\Procurement\Repositories\GoodsReceiptRepository;

class GoodsReceiptService
{
    public function __construct(
        protected GoodsReceiptRepository $goodsReceiptRepository,
        protected GoodsReceiptItemRepository $goodsReceiptItemRepository,
        protected NumberSeriesService $numberSeriesService,
        protected AuditService $auditService,
    ) {}

    public function getPaginated(int $perPage = 15)
    {
        return $this->goodsReceiptRepository->paginate($perPage);
    }

    public function findById(int $id): ?GoodsReceipt
    {
        return $this->goodsReceiptRepository->find($id);
    }

    public function create(array $data): GoodsReceipt
    {
        if (! isset($data['goods_receipt_number'])) {
            $data['goods_receipt_number'] = $this->numberSeriesService->generateNext('GR');
        }
        if (! isset($data['status'])) {
            $data['status'] = 'draft';
        }

        $items = $data['items'] ?? [];
        unset($data['items']);

        $goodsReceipt = $this->goodsReceiptRepository->create($data);

        foreach ($items as $item) {
            $item['goods_receipt_id'] = $goodsReceipt->id;
            if (empty($item['purchase_order_item_id']) && ! empty($goodsReceipt->purchase_order_id)) {
                $item['purchase_order_item_id'] = PurchaseOrderItem::where('purchase_order_id', $goodsReceipt->purchase_order_id)
                    ->where('product_id', $item['product_id'] ?? null)
                    ->value('id')
                    ?? PurchaseOrderItem::where('purchase_order_id', $goodsReceipt->purchase_order_id)->value('id');
            }
            $this->goodsReceiptItemRepository->create($item);
        }

        $this->auditService->logCreate('procurement', $goodsReceipt->goods_receipt_number, $data);

        return $goodsReceipt;
    }

    public function update(GoodsReceipt $goodsReceipt, array $data): bool
    {
        $items = $data['items'] ?? null;
        unset($data['items']);

        $oldValues = $goodsReceipt->toArray();
        $result = $this->goodsReceiptRepository->update($goodsReceipt, $data);

        if ($items !== null) {
            $goodsReceipt->items()->delete();
            foreach ($items as $item) {
                $item['goods_receipt_id'] = $goodsReceipt->id;
                if (empty($item['purchase_order_item_id']) && ! empty($goodsReceipt->purchase_order_id)) {
                    $item['purchase_order_item_id'] = PurchaseOrderItem::where('purchase_order_id', $goodsReceipt->purchase_order_id)
                        ->where('product_id', $item['product_id'] ?? null)
                        ->value('id')
                        ?? PurchaseOrderItem::where('purchase_order_id', $goodsReceipt->purchase_order_id)->value('id');
                }
                $this->goodsReceiptItemRepository->create($item);
            }
        }

        if ($result) {
            $this->auditService->logUpdate('procurement', $goodsReceipt->goods_receipt_number, $oldValues, $data);
        }

        return $result;
    }

    public function delete(GoodsReceipt $goodsReceipt): bool
    {
        $this->auditService->logDelete('procurement', $goodsReceipt->goods_receipt_number, $goodsReceipt->toArray());

        return $this->goodsReceiptRepository->delete($goodsReceipt);
    }

    public function complete(GoodsReceipt $goodsReceipt): bool
    {
        $goodsReceipt->status = 'completed';
        $result = $goodsReceipt->save();

        if ($result) {
            $this->auditService->logComplete('procurement', $goodsReceipt->goods_receipt_number);
        }

        return $result;
    }

    public function cancel(GoodsReceipt $goodsReceipt): bool
    {
        $goodsReceipt->status = 'cancelled';
        $result = $goodsReceipt->save();

        if ($result) {
            $this->auditService->logCancel('procurement', $goodsReceipt->goods_receipt_number);
        }

        return $result;
    }

    public function findByPurchaseOrder(int $purchaseOrderId)
    {
        return $this->goodsReceiptRepository->findByPurchaseOrder($purchaseOrderId);
    }

    public function findByStatus(string $status)
    {
        return $this->goodsReceiptRepository->findByStatus($status);
    }
}

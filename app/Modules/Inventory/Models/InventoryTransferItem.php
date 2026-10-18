<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\ProductMaster\Models\Product;
use Modules\ProductMaster\Models\UnitOfMeasure;

class InventoryTransferItem extends Model
{
    protected $table = 'inventory_transfer_items';

    protected $fillable = [
        'uuid',
        'inventory_transfer_id',
        'product_id',
        'uom_id',
        'quantity',
        'unit_cost',
        'batch_number',
        'expiry_date',
        'remarks',
        'created_by',
    ];

    protected $casts = [
        'quantity' => 'decimal:4',
        'unit_cost' => 'decimal:2',
        'expiry_date' => 'date',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (InventoryTransferItem $model) {
            $model->uuid = (string) Str::uuid();
            if (! $model->created_by) {
                $model->created_by = auth()->id();
            }
        });
    }

    public function inventoryTransfer()
    {
        return $this->belongsTo(InventoryTransfer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function uom()
    {
        return $this->belongsTo(UnitOfMeasure::class, 'uom_id');
    }
}

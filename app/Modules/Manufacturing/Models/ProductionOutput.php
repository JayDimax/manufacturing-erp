<?php

namespace Modules\Manufacturing\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Administration\Models\Warehouse;
use Modules\ProductMaster\Models\Product;
use Modules\ProductMaster\Models\UnitOfMeasure;

class ProductionOutput extends Model
{
    protected $table = 'production_outputs';

    protected $fillable = [
        'uuid',
        'output_number',
        'manufacturing_order_id',
        'product_id',
        'uom_id',
        'quantity_produced',
        'quantity_rejected',
        'quantity_waste',
        'batch_number',
        'warehouse_id',
        'status',
        'inspected_by',
        'inspected_at',
        'qc_remarks',
        'yield_percentage',
        'remarks',
        'created_by',
    ];

    protected $casts = [
        'inspected_at' => 'datetime',
        'quantity_produced' => 'decimal:4',
        'quantity_rejected' => 'decimal:4',
        'quantity_waste' => 'decimal:4',
        'yield_percentage' => 'decimal:2',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (ProductionOutput $model) {
            $model->uuid = (string) Str::uuid();
            if (! $model->created_by) {
                $model->created_by = auth()->id();
            }
        });
    }

    public function manufacturingOrder()
    {
        return $this->belongsTo(ManufacturingOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function uom()
    {
        return $this->belongsTo(UnitOfMeasure::class, 'uom_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }

    public function wasteRecords()
    {
        return $this->hasMany(WasteRecord::class);
    }
}

<?php

namespace Modules\Warehouse\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\Administration\Models\Warehouse;

class Picking extends Model
{
    use SoftDeletes;

    protected $table = 'pickings';

    protected $fillable = [
        'uuid', 'picking_number', 'warehouse_id',
        'picking_type', 'status',
        'reference_type', 'reference_id', 'reference_number',
        'picking_date', 'assigned_to', 'completed_at', 'remarks',
        'created_by', 'updated_by',
    ];

    protected $casts = [
        'picking_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Picking $model) {
            $model->uuid = (string) Str::uuid();
            if (! $model->created_by) {
                $model->created_by = auth()->id();
            }
        });
        static::updating(function (Picking $model) {
            $model->updated_by = auth()->id();
        });
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function reference()
    {
        return $this->morphTo();
    }

    public function items()
    {
        return $this->hasMany(PickingItem::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}

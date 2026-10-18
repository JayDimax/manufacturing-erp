<?php

namespace Modules\Manufacturing\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\Administration\Models\Warehouse;

class MaterialIssue extends Model
{
    use SoftDeletes;

    protected $table = 'material_issues';

    protected $fillable = [
        'uuid',
        'issue_number',
        'manufacturing_order_id',
        'warehouse_id',
        'issue_date',
        'status',
        'issued_by',
        'received_by',
        'description',
        'remarks',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (MaterialIssue $model) {
            $model->uuid = (string) Str::uuid();
            if (! $model->created_by) {
                $model->created_by = auth()->id();
            }
        });
        static::updating(function (MaterialIssue $model) {
            $model->updated_by = auth()->id();
        });
    }

    public function manufacturingOrder()
    {
        return $this->belongsTo(ManufacturingOrder::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function items()
    {
        return $this->hasMany(MaterialIssueItem::class);
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}

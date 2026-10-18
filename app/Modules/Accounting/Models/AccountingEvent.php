<?php

namespace Modules\Accounting\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\Administration\Models\Branch;

class AccountingEvent extends Model
{
    use SoftDeletes;

    protected $table = 'accounting_events';

    protected $fillable = [
        'uuid', 'event_number', 'transaction_type', 'transaction_number',
        'transaction_id', 'source_module', 'posting_date', 'branch_id',
        'currency', 'total_amount', 'status', 'error_message',
        'retry_count', 'posted_at', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'posting_date' => 'date',
        'posted_at' => 'datetime',
        'total_amount' => 'decimal:2',
        'retry_count' => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (AccountingEvent $model) {
            $model->uuid = (string) Str::uuid();
            if (! $model->created_by) {
                $model->created_by = auth()->id();
            }
        });
        static::updating(function (AccountingEvent $model) {
            $model->updated_by = auth()->id();
        });
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function postingQueue()
    {
        return $this->hasOne(PostingQueue::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

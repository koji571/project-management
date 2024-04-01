<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'content', 'creator_id', 'responsible_id', 'status_id','priority_id' ,'project_id', 'estimation',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id')->withTrashed();
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(RiskStatus::class, 'status_id', 'id')->withTrashed();
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(RiskPriority::class, 'priority_id', 'id')->withTrashed();
    }
}

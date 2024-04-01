<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiskPriority extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'color', 'is_default'
    ];

    public function risks(): HasMany
    {
        return $this->hasMany(Risk::class, 'priority_id', 'id')->withTrashed();
    }
}

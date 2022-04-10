<?php

namespace App\Models;

use App\Enums\VersionLabel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'label' => VersionLabel::class
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}

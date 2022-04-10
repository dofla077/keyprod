<?php

namespace App\Models;

use App\Enums\TypeLabel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'label' => TypeLabel::class
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

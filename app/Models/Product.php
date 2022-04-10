<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function orders(): MorphToMany
    {
        return $this->morphedByMany(Order::class, 'producttable');
    }

    public function shipments(): MorphToMany
    {
        return $this->morphedByMany(Shipment::class, 'producttable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_products_shipments')
            ->withPivot('product_state', 'weight');
    }

    public function Shipments(): BelongsToMany
    {
        return $this->belongsToMany(Shipment::class, 'orders_products_shipments')
            ->withPivot('product_state', 'weight');
    }
}

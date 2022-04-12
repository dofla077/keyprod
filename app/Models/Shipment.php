<?php

namespace App\Models;

use App\Enums\ShipmentState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'state' => ShipmentState::class
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_products_shipments')
            ->withPivot('product_state', 'weight');
    }

    public function Products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_products_shipments')
            ->withPivot('product_state', 'weight');
    }
}

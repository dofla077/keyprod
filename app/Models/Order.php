<?php

namespace App\Models;

use App\Enums\OrderState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];


    protected $casts = [
        'state' => OrderState::class
    ];


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_products_shipments')
            ->withPivot('product_state', 'weight', 'shipment_id');
    }

    public function shipments(): BelongsToMany
    {
        return $this->belongsToMany(Shipment::class, 'orders_products_shipments')
            ->withPivot('product_state', 'weight', 'product_id');
    }

}

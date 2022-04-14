<?php

namespace App\Services;

use App\Models\Shipment;

/**
 * OrderService
 */
class ShipmentService
{
    // shipment headers
    const HEADERS = [
        ['text' => 'Tracking', 'align' => 'start', 'sortable' => false, 'value' => 'tracking'],
        ['text' => 'State', 'value' => 'state'],
        ['text' => 'Products', 'value' => 'products'],
        ['text' => 'Updated_at', 'value' => 'updated_at'],
        ['text' => 'Shipping_at', 'value' => 'shipping_at'],
    ];

    /**
     * Shipments
     *
     * @return array
     */
    public function getShipments(): array
    {
        $shipments = Shipment::with('products', 'orders')->get(['id', 'tracking', 'state', 'shipping_at', 'updated_at']);

        return [$shipments->map(fn($item) => [
            'id' => $item->id,
            'tracking' => $item->tracking,
            'state' => $item->state,
            'products' => $item->products()->count() ?? 0,
            'shipping_at' => $item->shipping_at ? $item->shipping_at->format('Y-m-d') : 'N/A',
            'updated_at' => $item->updated_at->format('Y-m-d'),
        ]),
            collect(static::HEADERS),
        ];
    }
}

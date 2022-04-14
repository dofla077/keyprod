<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * OrderService
 */
class OrderService
{
    // orders headers
    const HEADERS = [
        ['text' => 'Order number', 'align' => 'start', 'sortable' => false, 'value' => 'number'],
        ['text' => 'State', 'value' => 'state'],
        ['text' => 'Products', 'value' => 'products'],
        ['text' => 'Shipments', 'value' => 'shipments'],
        ['text' => 'Updated_at', 'value' => 'updated_at'],
    ];

    // products of order headers
    const HEADERS_PRODUCTS = [
        ['text' => 'Label', 'align' => 'start', 'sortable' => false, 'value' => 'label'],
        ['text' => 'Type', 'value' => 'type'],
        ['text' => 'Version', 'value' => 'version'],
        ['text' => 'Identified', 'value' => 'identified'],
        ['text' => 'State', 'value' => 'state'],
        ['text' => 'Shipment', 'value' => 'shipment'],
        ['text' => 'Weight (kg)', 'value' => 'weight'],
        ['text' => 'Updated_at', 'value' => 'updated_at'],
    ];

    /**
     * Orders
     *
     * @return Collection|array
     */
    public function getOrders(): Collection|array
    {
        $orders = Order::with('products', 'shipments')->get(['id', 'number', 'state', 'updated_at']);

        return [$orders->map(fn($item) => [
            'id' => $item->id,
            'number' => $item->number,
            'state' => $item->state,
            'products' => $item->products()->count() ?? 0,
            'shipments' => $item->shipments()->count() ?? 0,
            'updated_at' => $item->updated_at->format('Y-m-d'),
        ]),
            collect(static::HEADERS),
        ];
    }

    /**
     * Order Products
     *
     * @param Order $order
     * @return array
     */
    public function getProducts(Order $order): array
    {
        return [
            $order->products->map(fn($item) => [
                'id' => $item->id,
                'label' => $item->type->label->value . '_' . $item->version->label->value . '_' . $item->label . $item->id . $item->version->id,
                'type' => $item->type->label,
                'version' => $item->version->label,
                'identified' => $item->label . $item->id . $item->version->id,
                'state' => $item->pivot->product_state,
                'shipment' => (bool)$item->pivot->shipment_id,
                'weight' => $item->pivot->weight ?? $item->weight,
                'updated_at' => $item->updated_at->format('Y-m-d'),
            ]),
            Product::whereNotIn('id', $order->products->pluck('id')->all())->get()->map(fn($item) => //$item->type->label->value . '_' . $item->version->label->value . '_' . $item->label . $item->id . $item->version->id
            [
                'id' => $item->id,
                'label' => $item->type->label->value . '_' . $item->version->label->value . '_' . $item->label . $item->id . $item->version->id,
                'type' => $item->type->label,
                'version' => $item->version->label,
                'identified' => $item->label . $item->id . $item->version->id,
                'updated_at' => $item->updated_at->format('Y-m-d'),
            ]
            ),
            collect(static::HEADERS_PRODUCTS),
        ];
    }
}

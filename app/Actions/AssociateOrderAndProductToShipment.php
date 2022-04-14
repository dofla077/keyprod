<?php

namespace App\Actions;

use App\Contracts\Actions\AssociateOrdersAndProductsToShipments;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;

class AssociateOrderAndProductToShipment implements AssociateOrdersAndProductsToShipments
{

    /**
     * @param Request $request
     * @param Shipment $shipment
     * @return void
     */
    public function __invoke(Request $request, Shipment $shipment): void
    {
        $order = Order::with('products')->findOrFail($request->get('order_id'));
        $product_ids = collect($request->get('products'))->pluck('id');
        $products = $order->products()->whereIn('products.id', $product_ids)->get();

        foreach ($products as $product) {
            $product->orders()->updateExistingPivot($order, [
                'shipment_id' => $shipment->id,
            ]);
        }
    }
}

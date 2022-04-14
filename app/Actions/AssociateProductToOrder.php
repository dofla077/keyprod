<?php

namespace App\Actions;

use App\Contracts\Actions\AssociatesProductsToOrder;
use App\Enums\ProductState;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * AssociateProductToOrder action
 */
class AssociateProductToOrder implements AssociatesProductsToOrder
{

    /**
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array
    {
        $order = Order::findOrFail($request->get('order_id'));

        $productArray = $request->get('product');
        $product = Product::findOrFail($productArray['id']);
        $product_weight = $request->get('weight') ?? $product->weight;
        $product_state = $request->get('state') == 1 ? ProductState::ToPrepare : ProductState::Prepared;

        $order->products()->attach($product, ['weight' => $product_weight, 'product_state' => $product_state]);

        return [
            'id' => $product->id,
            'label' => $product->type->label->value . '_' . $product->version->label->value . '_' . $product->label . $product->id . $product->version->id,
            'type' => $product->type->label,
            'version' => $product->version->label,
            'weight' => $product_weight,
            'state' => $product_state,
            'identified' => $product->label . $product->id . $product->version->id,
            'updated_at' => $product->updated_at->format('Y-m-d H:m:s'),
        ];
    }
}

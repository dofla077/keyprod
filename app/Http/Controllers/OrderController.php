<?php

namespace App\Http\Controllers;

use App\Actions\OnboardShipment;
use App\Contracts\Actions\AssociatesProductsToOrder;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public OrderService $orderService;

    /**
     * OrderController constructor
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        list($orders, $headers) = $this->orderService->getOrders();

        return view('orders.index', compact('orders', 'headers'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function products(Order $order)
    {
        $order->load('products');

        list($orderProducts, $products, $headers) = $this->orderService->getProducts(
            $order->load('products.version', 'products.type', 'products.shipments')
        );

        return view('orders.edit', compact('order', 'orderProducts','products', 'headers'));
    }

    /**
     * Add product to order
     *
     * @param Request $request
     * @param AssociatesProductsToOrder $associatesProductsToOrder
     * @return array
     */
    public function addProducts(Request $request, AssociatesProductsToOrder $associatesProductsToOrder)
    {
        return $associatesProductsToOrder($request);
    }

    /**
     * @param Request $request
     * @param OnboardShipment $onboardShipment
     * @return \App\Models\Shipment
     */
    public function addShipment(Request $request, OnboardShipment $onboardShipment)
    {
        return $onboardShipment($request);
    }
}

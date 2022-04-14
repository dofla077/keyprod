<?php

namespace App\Actions;

use App\Contracts\Actions\AddShipments;
use App\Contracts\Actions\AssociateOrdersAndProductsToShipments;
use App\Models\Shipment;
use Illuminate\Http\Request;

class OnboardShipment
{

    protected AddShipments $addShipments;
    protected AssociateOrdersAndProductsToShipments $ordersAndProductsToShipments;

    /**
     * @param AddShipments $addShipments
     * @param AssociateOrdersAndProductsToShipments $ordersAndProductsToShipments
     */
    public function __construct(AddShipments $addShipments, AssociateOrdersAndProductsToShipments $ordersAndProductsToShipments)
    {
        $this->addShipments = $addShipments;
        $this->ordersAndProductsToShipments = $ordersAndProductsToShipments;
    }

    /**
     * @param Request $request
     * @return Shipment
     */
    public function __invoke(Request $request): Shipment
    {
        $shipment = ($this->addShipments)();
        ($this->ordersAndProductsToShipments)($request, $shipment);

        return $shipment;
    }
}

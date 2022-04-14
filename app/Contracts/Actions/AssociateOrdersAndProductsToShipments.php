<?php

namespace App\Contracts\Actions;

use App\Models\Shipment;
use Illuminate\Http\Request;

interface AssociateOrdersAndProductsToShipments
{
    /**
     * @param Request $request
     * @param Shipment $shipment
     * @return void
     */
    public function __invoke(Request $request, Shipment $shipment): void;
}

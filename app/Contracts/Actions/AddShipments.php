<?php

namespace App\Contracts\Actions;

use App\Models\Shipment;

interface AddShipments
{
    /**
     * @return Shipment
     */
    public function __invoke(): Shipment;
}

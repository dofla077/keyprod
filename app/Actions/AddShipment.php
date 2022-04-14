<?php

namespace App\Actions;

use App\Contracts\Actions\AddShipments;
use App\Enums\ShipmentState;
use App\Models\Shipment;
use Str;

class AddShipment implements AddShipments
{
    /**
     * @return Shipment
     */
    public function __invoke(): Shipment
    {
        return Shipment::create([
            'state' => ShipmentState::InProgress,
            'tracking' => Str::uuid()
        ]);
    }
}

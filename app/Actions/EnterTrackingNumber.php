<?php

namespace App\Actions;

use App\Contracts\Actions\EnterTrackingNumbers;
use App\Models\Shipment;
use Illuminate\Http\Request;

class EnterTrackingNumber implements EnterTrackingNumbers
{

    /**
     * @param Request $request
     * @return bool
     */
    public function __invoke(Request $request): bool
    {
        $shipment = Shipment::findOrFail($request->get('id'));
        $shipment->tracking = $request->get('tracking');

        return $shipment->save();
    }
}

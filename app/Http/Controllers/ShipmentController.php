<?php

namespace App\Http\Controllers;

use App\Contracts\Actions\EnterTrackingNumbers;
use App\Services\ShipmentService;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    protected ShipmentService $shipmentService;

    /**
     * @param ShipmentService $shipmentService
     */
    public function __construct(ShipmentService $shipmentService)
    {
        $this->shipmentService = $shipmentService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        list($shipments, $headers) = $this->shipmentService->getShipments();

        return view('shipments.index', compact('shipments', 'headers'));
    }

    /**
     * Update tracking number
     *
     * @param Request $request
     * @param EnterTrackingNumbers $enterTrackingNumbers
     * @return bool
     */
    public function tracking(Request $request, EnterTrackingNumbers $enterTrackingNumbers)
    {
        return $enterTrackingNumbers($request);
    }
}

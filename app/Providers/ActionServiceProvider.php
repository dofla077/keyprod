<?php

namespace App\Providers;

use App\Actions\AddShipment;
use App\Actions\AssociateOrderAndProductToShipment;
use App\Actions\AssociateProductToOrder;
use App\Actions\EnterTrackingNumber;
use App\Contracts\Actions\AddShipments;
use App\Contracts\Actions\AssociateOrdersAndProductsToShipments;
use App\Contracts\Actions\AssociatesProductsToOrder;
use App\Contracts\Actions\EnterTrackingNumbers;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * Bind contracts to actions
     *
     * @var array|string[]
     */
    public array $bindings = [
        AssociatesProductsToOrder::class => AssociateProductToOrder::class,
        AssociateOrdersAndProductsToShipments::class => AssociateOrderAndProductToShipment::class,
        AddShipments::class => AddShipment::class,
        EnterTrackingNumbers::class => EnterTrackingNumber::class
    ];
}

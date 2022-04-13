<?php

namespace App\Providers;

use App\Actions\AssociateProductToOrder;
use App\Contracts\Actions\AssociatesProductsToOrder;
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
    ];
}

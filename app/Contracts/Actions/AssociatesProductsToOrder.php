<?php

namespace App\Contracts\Actions;

use Illuminate\Http\Request;

/**
 * AssociatesProductsToOrder contract
 */
interface AssociatesProductsToOrder
{
    /**
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array;
}

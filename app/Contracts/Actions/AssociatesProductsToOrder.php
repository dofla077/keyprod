<?php

namespace App\Contracts\Actions;

use Illuminate\Http\Request;

interface AssociatesProductsToOrder
{
    public function __invoke(Request $request);
}

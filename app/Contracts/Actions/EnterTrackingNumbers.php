<?php

namespace App\Contracts\Actions;

use Illuminate\Http\Request;

interface EnterTrackingNumbers
{
    /**
     * @param Request $request
     * @return bool
     */
    public function __invoke(Request $request): bool;
}

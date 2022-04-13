<?php

namespace App\Actions;

use App\Contracts\Actions\AssociatesProductsToOrder;
use Illuminate\Http\Request;

class AssociateProductToOrder implements AssociatesProductsToOrder
{

    /**
     * @param Request $request
     * @return void
     */
    public function __invoke(Request $request)
    {

        dump('youpi');
        dd($request->all());
    }
}

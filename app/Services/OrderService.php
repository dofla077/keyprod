<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

/**
 * OrderService
 */
class OrderService
{

    /**
     * Orders
     *
     * @return Collection|array
     */
    public function getOrders(): Collection|array
    {
       return Order::get(['id', 'number', 'state', 'created_at', 'updated_at']);
    }
}

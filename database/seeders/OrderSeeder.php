<?php

namespace Database\Seeders;

use App\Enums\ProductState;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory(5)->create();
        $orders = Order::get();

        foreach ($orders as $order) {
            $order->products()->syncWithPivotValues(
                [1, 2, 3],
                ['product_state' => ProductState::ToPrepare, 'weight' => 5]
            );
        }
    }
}

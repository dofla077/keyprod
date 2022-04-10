<?php

namespace App\Models;

use App\Enums\OrderState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
      'state' => OrderState::class
    ];


    public function Products(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'producttable')
            ->withPivot('product_state', 'uniqueness', 'weight');
    }

}

<?php

namespace App\Http\Controllers;

use App\Enums\TypeLabel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }
}

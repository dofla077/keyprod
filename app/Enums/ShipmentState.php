<?php

namespace App\Enums;

enum ShipmentState: string
{
    case InProgress = 'in progress';
    case Shipped = 'shipped';
    case Archived = 'archived';
}

<?php

namespace App\Enums;

enum ProductState: string
{
    case ToPrepare = 'to prepare';
    case Prepared = 'prepared';
}

<?php

namespace App\Enums;

enum OrderState: string
{
    case Draft = 'draft';
    case Finish = 'finish';
    case Archived = 'archived';
}

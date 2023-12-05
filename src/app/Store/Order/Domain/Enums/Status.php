<?php

namespace App\Store\Order\Domain\Enums;

enum Status: string
{
    case CREATED  = 'created';
    case UNPAID   = 'unpaid';
    case PAID     = 'paid';
    case DONE     = 'done';
    case CANCELED = 'canceled';
    case REFUND   = 'refund';
}

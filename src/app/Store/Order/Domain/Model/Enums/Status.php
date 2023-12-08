<?php

namespace App\Store\Order\Domain\Model\Enums;

enum Status: string
{
    case CREATED  = 'created';
    case UNPAID   = 'unpaid';
    case PAID     = 'paid';
    case DONE     = 'done';
    case CANCELED = 'canceled';
    case REFUND   = 'refund';
}

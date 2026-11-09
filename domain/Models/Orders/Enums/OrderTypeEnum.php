<?php

namespace Gal\Models\Orders\Enums;

enum OrderTypeEnum: string
{
    case DELIVERY = 'delivery';
    case PICKUP = 'pickup';
}

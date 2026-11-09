<?php

namespace Gal\Models\Orders\Enums;

enum OrderStatusEnum: string
{
    case NEW = 'new';
    case CONFIRMED = 'confirmed';
    case IN_PRODUCTION = 'in_production';
    case OUT_FOR_DELIVERY = 'out_for_delivery';
    case FINISHED = 'finished';
    case CANCELED = 'canceled';
}

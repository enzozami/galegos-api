<?php

namespace Gal\Base\Traits;

trait HasUuidRouteKey
{
    public function uniqueIds(): array
    {
        return ['uuid'];
    }
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
